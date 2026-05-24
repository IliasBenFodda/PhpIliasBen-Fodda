<x-app-layout>
    @php $other = $conversation->otherUser(auth()->id()); @endphp

    <div class="max-w-2xl mx-auto py-8 px-4 flex flex-col" style="height: calc(100vh - 80px);">
        <!-- Header -->
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('conversations.index') }}" class="text-gray-400 hover:text-gray-600">
                ← Terug
            </a>
            <div
                class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
            </div>
            <span class="font-semibold text-gray-800">{{ $other?->name ?? 'Onbekend' }}</span>
        </div>

        <!-- Berichten -->
        <div class="flex-1 overflow-y-auto bg-white rounded-lg shadow p-4 space-y-3 mb-4" id="messages">
            @forelse($conversation->messages as $message)
                @php $isMine = $message->user_id === auth()->id(); @endphp
                <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-xs lg:max-w-md">
                        @unless($isMine)
                            <div class="text-xs text-gray-400 mb-1">{{ $message->user->name }}</div>
                        @endunless
                        <div class="px-4 py-2 rounded-2xl text-sm
                            {{ $isMine ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-gray-100 text-gray-800 rounded-bl-none' }}">
                            {{ $message->body }}
                        </div>
                        <div class="text-xs text-gray-400 mt-1 {{ $isMine ? 'text-right' : '' }}">
                            {{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 text-sm py-8">Nog geen berichten. Stuur het eerste bericht!</p>
            @endforelse
        </div>

        <!-- Invoerveld -->
        <form method="POST" action="{{ route('conversations.messages.store', $conversation) }}" class="flex gap-2">
            @csrf
            <input type="text" name="body" required maxlength="2000" placeholder="Typ een bericht..."
                   autofocus autocomplete="off"
                   class="flex-1 border-gray-300 rounded-full px-4 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white text-sm rounded-full hover:bg-indigo-700 transition shrink-0">
                Verstuur
            </button>
        </form>
    </div>

    <script>
        // Scroll naar beneden bij laden
        const messages = document.getElementById('messages');
        if (messages) messages.scrollTop = messages.scrollHeight;
    </script>
</x-app-layout>
