@props(['position' => 'bottom-right'])

<!-- Chat Button -->
<button 
    id="chatbot-toggle" 
    class="fixed z-50 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 {{ $position === 'bottom-right' ? 'bottom-6 right-6' : 'bottom-6 left-6' }}"
    onclick="toggleChatbot()"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
    </svg>
</button>

<!-- Chat Window -->
<div 
    id="chatbot-window" 
    class="fixed z-50 hidden {{ $position === 'bottom-right' ? 'bottom-20 right-6' : 'bottom-20 left-6' }} w-80 md:w-96 bg-white rounded-lg shadow-2xl border border-gray-200"
>
    <!-- Header -->
    <div class="bg-blue-600 text-white p-4 rounded-t-lg flex justify-between items-center">
        <h3 class="font-semibold">🤖 AI Assistant</h3>
        <button onclick="toggleChatbot()" class="hover:bg-blue-700 rounded p-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <!-- Messages -->
    <div id="chatbot-messages" class="h-80 overflow-y-auto p-4 space-y-3 bg-gray-50">
        <div class="flex justify-start">
            <div class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg max-w-xs">
                Hello! How can I help you today? 👋
            </div>
        </div>
    </div>

    <!-- Input -->
    <form id="chatbot-form" class="p-4 border-t border-gray-200 bg-white rounded-b-lg flex gap-2">
        @csrf
        <input 
            type="text" 
            id="chatbot-input"
            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Type your message..."
            autocomplete="off"
        >
        <button 
            type="submit" 
            id="chatbot-send"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition disabled:opacity-50"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
            </svg>
        </button>
    </form>
</div>

<script>
// Toggle chat window
function toggleChatbot() {
    const window = document.getElementById('chatbot-window');
    window.classList.toggle('hidden');
    if (!window.classList.contains('hidden')) {
        document.getElementById('chatbot-input').focus();
    }
}

// Handle form submission
document.getElementById('chatbot-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const input = document.getElementById('chatbot-input');
    const sendBtn = document.getElementById('chatbot-send');
    const messagesDiv = document.getElementById('chatbot-messages');
    const message = input.value.trim();
    
    if (!message) return;

    // Add user message
    messagesDiv.innerHTML += `
        <div class="flex justify-end">
            <div class="bg-blue-600 text-white px-4 py-2 rounded-lg max-w-xs">
                ${message}
            </div>
        </div>
    `;
    
    input.value = '';
    sendBtn.disabled = true;
    messagesDiv.scrollTop = messagesDiv.scrollHeight;

    try {
        const response = await fetch('{{ route("chat.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ message })
        });

        const data = await response.json();

        if (data.success) {
            messagesDiv.innerHTML += `
                <div class="flex justify-start">
                    <div class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg max-w-xs">
                        ${data.reply}
                    </div>
                </div>
            `;
        } else {
            messagesDiv.innerHTML += `
                <div class="flex justify-start">
                    <div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg max-w-xs">
                        ${data.error || 'Sorry, something went wrong.'}
                    </div>
                </div>
            `;
        }
    } catch (error) {
        messagesDiv.innerHTML += `
            <div class="flex justify-start">
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg max-w-xs">
                    Connection error. Is Ollama running?
                </div>
            </div>
        `;
    }

    sendBtn.disabled = false;
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
});
</script>