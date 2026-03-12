<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;

class OllamaService
{
    protected $baseUrl;
    protected $model;

    // 🎯 SITE CONTEXT: What your chatbot should know
    protected $siteContext = <<<CONTEXT
    You are the official AI assistant for "Mondial 2030 Maroc" — a guide website for the 2030 FIFA World Cup in Morocco.

    🌍 WEBSITE PURPOSE:
    - Help visitors plan their trip to Morocco for the World Cup
    - Provide info about host cities, stadiums, accommodations, restaurants, matches, and practical tips
    - Answer questions in French, English, Arabic, or Spanish

    📋 DATA YOU HAVE ACCESS TO (via database injection):
    When the user asks about cities, stadiums, hotels, restaurants, matches, pharmacies, or emergencies, 
    you will receive a "📋 INFORMATIONS DU SITE" block with REAL DATA from the website's database.
    USE THIS DATA to answer accurately.

    🎯 RESPONSE GUIDELINES:
    ✅ DO:
    - Use the injected site data when available (it's labeled "de NOTRE site")
    - Direct users to specific pages: "Consultez notre page [Villes/Stades/Hôtels] pour plus de détails"
    - Be helpful, friendly, and concise
    - Use emojis sparingly to match the site's style 🇲🇦⚽
    - If site data is empty, say: "Je n'ai pas encore ces informations dans notre base. Voici ce que je sais en général..."

    ❌ DON'T:
    - Don't suggest external sites like Google Maps or DGAM — we have that info ON OUR SITE
    - Don't say "I don't have access" — instead: "Consultez notre page [X] pour la liste complète"
    - Don't make up data — if no site data injected, use general knowledge but label it clearly

    🗂️ PAGE REFERENCES (use these when directing users):
    - Villes: /villes
    - Stades: /stades  
    - Hôtels: /hotels
    - Airbnbs: /airbnbs
    - Restaurants: /restaurants
    - Matchs: /games or /matches
    - Pharmacies: /pharmacies
    - Urgences: /emergences
    - Convertisseur: /convertisseur
    - Carte interactive: /carte

    🔄 EXAMPLE FLOW:
    User: "Où sont les pharmacies à Marrakech ?"
    → detectSiteQuery() finds "pharmacie" + "Marrakech"
    → getModelData('Pharmacy') returns real DB rows
    → Context injected: "💊 PHARMACIES (de NOTRE site): - Pharmacie Al Andalous (Marrakech): Avenue Mohammed V 📞 0524-xxx"
    → You respond: "💊 À Marrakech, notre site liste : Pharmacie Al Andalous (Avenue Mohammed V, 📞 0524-xxx). Consultez notre page /pharmacies pour la liste complète et les horaires."
    CONTEXT;

    public function __construct()
    {
        $this->baseUrl = config('services.ollama.base_url', 'http://localhost:11434');
        $this->model = config('services.ollama.model', 'llama3.2');
    }

    /**
     * Safely get data from a model if it exists
     * 
     * @param string $modelClass
     * @param array<string> $columns
     * @param int $limit
     * @return array<int, array<string, mixed>>
     */
    /**
 * Safely get data from a model if it exists - WITH DEBUG LOGGING
 */
    protected function getModelData(string $modelClass, array $columns, int $limit = 5): array
    {
        // Log the attempt
        \Illuminate\Support\Facades\Log::debug('getModelData called', [
            'model' => $modelClass,
            'columns' => $columns,
            'limit' => $limit
        ]);

        // Check if model class exists before using it
        if (!class_exists($modelClass)) {
            \Illuminate\Support\Facades\Log::warning('Model class does not exist', ['model' => $modelClass]);
            return [];
        }

        try {
            $data = $modelClass::limit($limit)->get($columns)->toArray();
            
           \Illuminate\Support\Facades\Log::debug('getModelData result', [
                'model' => $modelClass,
                'records_found' => count($data),
                'sample' => array_slice($data, 0, 2) // Log first 2 for debugging
            ]);
            
            return $data;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('getModelData failed', [
                'model' => $modelClass,
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * Detect if user is asking about site-specific data
     * 
     * @param string $message
     * @return string[]
     */
    protected function detectSiteQuery(string $message): array
    {
        $messageLower = strtolower($message);
        $context = [];

        try {
            // 🏙️ Cities
            if (preg_match('/(ville|cité|casablanca|rabat|marrakech|tanger|fès|agadir|oujda|host|city)/i', $messageLower)) {
                $cities = \App\Models\Ville::limit(5)->get(['nom', 'description'])->toArray();
                if ($cities) {
                    $context[] = "🏙️ VILLES HÔTES (de NOTRE site):\n" . collect($cities)->map(fn($c) => "- {$c['nom']}: {$c['description']}")->join("\n");
                }
            }

            // 🏟️ Stadiums
            if (preg_match('/(stade|stadium|arena|capacité|place)/i', $messageLower)) {
                $stadiums = \App\Models\Stade::with('ville:id,nom')->limit(5)->get(['id','nom', 'ville_id', 'capacite'])->toArray();
                if ($stadiums) {
                    $context[] = "🏟️ STADES (de NOTRE site):\n" . collect($stadiums)->map(fn($s) => "- {$s['nom']} (" . ($s['ville']['nom'] ?? 'Inconnue') . "): {$s['capacite']} places")->join("\n");
                }
            }

            // 🏨 Hotels
            if (preg_match('/(hôtel|hotel|hébergement|logement|dormir|airbnb)/i', $messageLower)) {
                $hotels = \App\Models\Hotel::with('ville:id,nom')->limit(5)->get(['id','nom', 'ville_id', 'prix_nuit', 'etoiles'])->toArray();
                if ($hotels) {
                    $context[] = "🏨 HÉBERGEMENTS (de NOTRE site):\n" . collect($hotels)->map(fn($h) => "- {$h['nom']} (" . ($h['ville']['nom'] ?? 'Inconnue') . "): {$h['prix_nuit']} Dhs, ⭐{$h['etoiles']}")->join("\n");
                }
            }

            // 🍽️ Restaurants
            if (preg_match('/(restaurant|resto|manger|cuisine|tajine|couscous)/i', $messageLower)) {
                $restaurants = \App\Models\Restaurant::with('ville:id,nom')->limit(5)->get(['id','nom', 'ville_id', 'type_cuisine'])->toArray();
                if ($restaurants) {
                    $context[] = "🍽️ RESTAURANTS (de NOTRE site):\n" . collect($restaurants)->map(fn($r) => "- {$r['nom']} (" . ($r['ville']['nom'] ?? 'Inconnue') . "): Cuisine {$r['type_cuisine']}")->join("\n");
                }
            }

            // ⚽ Matches
            if (preg_match('/(match|équipe|calendrier|horaire|billet|ticket|jouer)/i', $messageLower)) {
                $matches = \App\Models\Game::with('stade:id,nom')->limit(3)->get(['id','stade_id', 'equipe1', 'equipe2', 'date_match', 'heure_match'])->toArray();
                if ($matches) {
                    $context[] = "⚽ MATCHS (de NOTRE site):\n" . collect($matches)->map(fn($m) => "- {$m['equipe1']} vs {$m['equipe2']} — {$m['date_match']} à {$m['heure_match']} au stade " . ($m['stade']['nom'] ?? 'Inconnu'))->join("\n");
                }
            }

            // 💊 Pharmacies
            if (preg_match('/(pharmacie|pharma|médicament|ordonnance|urgence santé)/i', $messageLower)) {
                $pharmacies = \App\Models\Pharmacie::with('ville:id,nom')->limit(5)->get(['id','nom', 'ville_id', 'adresse', 'telephone', 'horaires_ouverture'])->toArray();
                if ($pharmacies) {
                    $context[] = "💊 PHARMACIES (de NOTRE site):\n" . collect($pharmacies)->map(fn($p) => "- {$p['nom']} (" . ($p['ville']['nom'] ?? 'Inconnue') . "): {$p['adresse']} - Horaires: {$p['horaires_ouverture']} 📞 {$p['telephone']}")->join("\n");
                }
            }

            // 🚨 Emergencies
            if (preg_match('/(urgence|pompiers|police|ambulance|150|190|hôpital)/i', $messageLower)) {
                $emergencies = \App\Models\Urgence::with('ville:id,nom')->limit(5)->get(['id','type', 'numero', 'ville_id'])->toArray();
                if ($emergencies) {
                    $context[] = "🚨 URGENCES (de NOTRE site):\n" . collect($emergencies)->map(fn($e) => "- {$e['type']} (" . ($e['ville']['nom'] ?? 'Inconnue') . ") 📞 {$e['numero']}")->join("\n");
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('DB Context Injection Error', ['error' => $e->getMessage()]);
        }

        \Illuminate\Support\Facades\Log::info('detectSiteQuery result', [
            'user_message_snippet' => substr($message, 0, 100),
            'context_blocks_found' => count($context),
            'context_preview' => array_map(fn($c) => substr($c, 0, 200) . '...', $context)
        ]);
        return $context;
    }

    /**
     * Build final prompt with context injection
     * 
     * @param string $userMessage
     * @param array<int, array{role: string, content: string}> $conversationHistory
     * @return array<int, array{role: string, content: string}>
     */
    protected function buildPrompt(string $userMessage, array $conversationHistory = []): array
    {
        $messages = [
            ['role' => 'system', 'content' => $this->siteContext]
        ];

        $recentHistory = array_slice($conversationHistory, -10);
        foreach ($recentHistory as $msg) {
            $messages[] = $msg;
        }

        $siteContext = $this->detectSiteQuery($userMessage);

        if (!empty($siteContext)) {
            $contextBlock = "\n\n📋 INFORMATIONS DU SITE (pour vous aider à répondre):\n" . implode("\n\n", $siteContext);
            $messages[] = ['role' => 'user', 'content' => $userMessage . $contextBlock];
        } else {
            $messages[] = ['role' => 'user', 'content' => $userMessage];
        }

        return $messages;
    }

    /**
     * NON-STREAMING chat with context injection
     * 
     * @param array<int, array{role: string, content: string}> $messages
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    public function chat(array $messages, array $options = []): array
    {
        try {
            /** @var Response $response */
            $response = Http::timeout(120)->post("{$this->baseUrl}/api/chat", [
                'model' => $this->model,
                'messages' => $messages,
                'stream' => false,
                ...$options
            ]);

            if ($response->failed()) {
                Log::error('Ollama API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                throw new \Exception('Ollama API request failed');
            }

            return $response->json();

        } catch (\Exception $e) {
            Log::error('Ollama Connection Error', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * STREAMING chat with context injection
     * 
     * @param array<int, array{role: string, content: string}> $messages
     * @param array<string, mixed> $options
     * @param callable(string):void|null $onChunk
     * @return void
     */
    public function chatStream(array $messages, array $options = [], ?callable $onChunk = null): void
    {
        $url = "{$this->baseUrl}/api/chat";
        $payload = json_encode([
            'model' => $this->model,
            'messages' => $messages,
            'stream' => true,
            ...$options
        ], JSON_UNESCAPED_UNICODE);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_RETURNTRANSFER => false,
            CURLOPT_WRITEFUNCTION => function($curl, $data) use ($onChunk): int {
                $lines = explode("\n", trim($data));
                foreach ($lines as $line) {
                    if (empty($line)) continue;
                    $json = json_decode($line, true);
                    if ($json && isset($json['message']['content']) && $onChunk) {
                        $onChunk($json['message']['content']);
                    }
                }
                return strlen($data);
            },
            CURLOPT_TIMEOUT => 120,
        ]);

        curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('Ollama stream error: ' . curl_error($ch));
        }
        curl_close($ch);
    }

    /**
     * Simple helper: ask with automatic context injection
     * 
     * @param string $userMessage
     * @param array<int, array{role: string, content: string}> $conversationHistory
     * @return array{reply: string, full_response: array<string, mixed>}
     */
    public function ask(string $userMessage, array $conversationHistory = []): array
    {
        $messages = $this->buildPrompt($userMessage, $conversationHistory);
        $response = $this->chat($messages);
        
        return [
            'reply' => $response['message']['content'],
            'full_response' => $response
        ];
    }

    /**
     * Check if Ollama server is healthy
     */
    public function isHealthy(): bool
    {
        try {
            /** @var Response $response */
            $response = Http::timeout(5)->get("{$this->baseUrl}/api/tags");
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}