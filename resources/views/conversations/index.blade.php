<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Mijn chats</h1>
            <a href="{{ route('conversations.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700 transition">
                + Nieuwe chat
            </a>
        </div>

        @if($conversations->isEmpty())
            <p class="text-gray-500 text-center py-12">Je hebt nog geen chats. Start een nieuwe chat!</p>
        @else
            <div class="bg-white rounded-lg shadow divide-y divide-gray-100">
                @foreach($conversations as $conversation)
                    @php $other = $conversation->otherUser(auth()->id()); @endphp
                    <a href="{{ route('conversations.show', $conversation) }}"
                       class="flex items-center gap-4 px-5 py-4 hover:bg-gray-50 transition">
                        <div
                            class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold shrink-0">
                            {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-medium text-gray-900">{{ $other?->name ?? 'Onbekend' }}</div>
                            <div class="text-sm text-gray-500 truncate">
                                {{ $conversation->latestMessage?->body ?? 'Nog geen berichten' }}
                            </div>
                        </div>
                        <div class="text-xs text-gray-400 shrink-0">
                            {{ $conversation->latestMessage?->created_at->diffForHumans() ?? '' }}
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
