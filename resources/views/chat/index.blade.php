@extends('layouts.app')

@section('content')
<div class="container max-w-2xl mx-auto py-8" data-send-route="{{ route('chat.send') }}">
    <h1 class="text-3xl font-bold mb-6">🤖 AI Chatbot</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Chat Messages -->
    <div id="chat-box" class="bg-white rounded-lg shadow-md p-4 h-96 overflow-y-auto mb-4">
        @forelse($messages as $msg)
            <div class="mb-3 {{ $msg['role'] === 'user' ? 'text-right' : 'text-left' }}">
                <span class="inline-block px-4 py-2 rounded-lg {{ 
                    $msg['role'] === 'user' 
                        ? 'bg-blue-500 text-white' 
                        : 'bg-gray-200 text-gray-800' 
                }}">
                    {{ $msg['content'] }}
                </span>
            </div>
        @empty
            <p class="text-gray-500 text-center">Start a conversation!</p>
        @endforelse
    </div>

    <!-- Input Form -->
    <form id="chat-form" class="flex gap-2">
        @csrf
        <input 
            type="text" 
            name="message" 
            id="message-input"
            class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Type your message..."
            autocomplete="off"
        >
        <button 
            type="submit" 
            id="send-btn"
            class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition"
        >
            Send
        </button>
    </form>

    <!-- Clear Button -->
    <form action="{{ route('chat.clear') }}" method="POST" class="mt-4">
        @csrf
        <button class="text-red-500 hover:text-red-700 text-sm">
            🗑️ Clear Conversation
        </button>
    </form>
</div>

<script>
document.getElementById('chat-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const messageInput = document.getElementById('message-input');
    const sendBtn = document.getElementById('send-btn');
    const chatBox = document.getElementById('chat-box');
    
    const message = messageInput.value.trim();
    if (!message) return;

    // Show user message immediately
    chatBox.innerHTML += `
        <div class="mb-3 text-right">
            <span class="inline-block px-4 py-2 rounded-lg bg-blue-500 text-white">
                ${message}
            </span>
        </div>
    `;
    
    messageInput.value = '';
    sendBtn.disabled = true;
    sendBtn.textContent = '...';
    chatBox.scrollTop = chatBox.scrollHeight;

    try {
        const response = await fetch(document.querySelector('.container').dataset.sendRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ message })
        });

        const data = await response.json();

        if (data.success) {
            chatBox.innerHTML += `
                <div class="mb-3 text-left">
                    <span class="inline-block px-4 py-2 rounded-lg bg-gray-200 text-gray-800">
                        ${data.reply}
                    </span>
                </div>
            `;
        } else {
            chatBox.innerHTML += `
                <div class="mb-3 text-left">
                    <span class="inline-block px-4 py-2 rounded-lg bg-red-100 text-red-800">
                        ${data.error}
                    </span>
                </div>
            `;
        }
    } catch (error) {
        chatBox.innerHTML += `
            <div class="mb-3 text-left">
                <span class="inline-block px-4 py-2 rounded-lg bg-red-100 text-red-800">
                    Connection error
                </span>
            </div>
        `;
    }

    sendBtn.disabled = false;
    sendBtn.textContent = 'Send';
    chatBox.scrollTop = chatBox.scrollHeight;
});
</script>
@endsection