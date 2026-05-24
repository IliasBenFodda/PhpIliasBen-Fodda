<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Forum</h2>
            <a href="{{ route('forum.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                + Nieuw onderwerp
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @forelse($threads as $thread)
                <div class="bg-white shadow-sm sm:rounded-lg mb-4 hover:shadow-md transition">
                    <div class="p-5">
                        <div class="flex justify-between items-start gap-4">
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('forum.show', $thread) }}"
                                   class="text-lg font-semibold text-gray-900 hover:text-indigo-600 leading-tight">
                                    {{ $thread->title }}
                                </a>
                                <p class="mt-1 text-sm text-gray-500 line-clamp-2">
                                    {{ Str::limit($thread->body, 150) }}
                                </p>
                            </div>
                            <div class="shrink-0 text-center">
                                <span class="text-2xl font-bold text-indigo-600">{{ $thread->replies_count }}</span>
                                <p class="text-xs text-gray-400">{{ Str::plural('antwoord', $thread->replies_count) }}</p>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-2 text-xs text-gray-400">
                            <span>Door <span class="font-medium text-gray-600">{{ $thread->user->name }}</span></span>
                            <span>&middot;</span>
                            <span>{{ $thread->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm sm:rounded-lg p-10 text-center text-gray-500">
                    <p class="text-lg mb-2">Nog geen onderwerpen.</p>
                    <a href="{{ route('forum.create') }}"
                       class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                        Start het eerste gesprek &rarr;
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
