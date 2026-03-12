<?php

namespace App\Http\Controllers;

use App\Services\ollamaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    protected $ollama;

    public function __construct(OllamaService $ollama)
    {
        $this->ollama = $ollama;
    }

    /**
     * Non-streaming endpoint (with context injection)
     */
    public function send(Request $request)
    {
        $request->validate(['message' => 'required|string|max:2000']);

        $conversation = Session::get('conversation', []);

        try {
            // ✅ Use the context-aware ask() method (calls buildPrompt internally)
            $result = $this->ollama->ask($request->message, $conversation);
            
            // Save to session
            $conversation[] = ['role' => 'user', 'content' => $request->message];
            $conversation[] = ['role' => 'assistant', 'content' => $result['reply']];
            $conversation = array_slice($conversation, -20);
            Session::put('conversation', $conversation);

            return response()->json([
                'success' => true,
                'reply' => $result['reply'],
            ]);

        } catch (\Exception $e) {
            Log::error('Chat send error', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'error' => 'Désolé, je n\'arrive pas à vous aider pour le moment. Veuillez réessayer.'
            ], 500);
        }
    }

    /**
     * Streaming endpoint (with context injection)
     */
    public function stream(Request $request)
    {
        $request->validate(['message' => 'required|string|max:2000']);

        // ⚠️ CRITICAL: Clear ALL output buffering BEFORE any headers
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        ob_implicit_flush(true);

        // Set SSE headers (must be before ANY output)
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Connection: keep-alive');
        header('X-Accel-Buffering: no');
        header('Content-Encoding: none');

        // Send start signal
        echo " " . json_encode(['type' => 'start'], JSON_UNESCAPED_UNICODE) . "\n\n";
        flush();

        $conversation = Session::get('conversation', []);
        
        // ✅ FIXED: Use buildPrompt() for context injection
        $messages = $this->ollama->buildPrompt($request->message, $conversation);

        $fullReply = '';

        try {
            // Stream with context-aware messages
            $this->ollama->chatStream($messages, [], function($chunk) use (&$fullReply) {
                echo " " . json_encode(['type' => 'content', 'text' => $chunk], JSON_UNESCAPED_UNICODE) . "\n\n";
                flush();
                $fullReply .= $chunk;
            });
            
            // Save to session after streaming completes
            $conversation[] = ['role' => 'user', 'content' => $request->message];
            $conversation[] = ['role' => 'assistant', 'content' => $fullReply];
            $conversation = array_slice($conversation, -20);
            Session::put('conversation', $conversation);
            
            // Send end signal
            echo " " . json_encode(['type' => 'end'], JSON_UNESCAPED_UNICODE) . "\n\n";
            flush();

        } catch (\Exception $e) {
            Log::error('Chat stream error', ['error' => $e->getMessage()]);
            echo " " . json_encode(['type' => 'error', 'message' => 'Erreur interne'], JSON_UNESCAPED_UNICODE) . "\n\n";
            flush();
        }

        // ⚠️ CRITICAL: Stop Laravel from rendering views after streaming
        exit;
    }

    public function clear()
    {
        Session::forget('conversation');
        return response()->json(['success' => true]);
    }
}