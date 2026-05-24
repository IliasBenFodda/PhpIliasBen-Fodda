<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('forum.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight truncate">{{ $thread->title }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-md text-sm">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-sm font-bold text-indigo-600">
                                    {{ strtoupper(substr($thread->user->name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="font-semibold text-gray-900">{{ $thread->user->name }}</span>
                                <span class="text-xs text-gray-400">&middot;</span>
                                <span class="text-xs text-gray-400"
                                      title="{{ $thread->created_at->format('d/m/Y H:i') }}">
                                    {{ $thread->created_at->diffForHumans() }}
                                </span>
                                @if($thread->user->isAdmin())
                                    <span
                                        class="px-2 py-0.5 text-xs rounded-full bg-indigo-100 text-indigo-700 font-medium">Beheerder</span>
                                @endif
                            </div>
                            <div class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $thread->body }}</div>
                        </div>
                    </div>
                </div>
            </div>

            @if($thread->replies->isNotEmpty())
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">
                        {{ $thread->replies->count() }} {{ Str::plural('Antwoord', $thread->replies->count()) }}
                    </h3>

                    <div class="space-y-4">
                        @foreach($thread->replies as $reply)
                            <div class="bg-white shadow-sm sm:rounded-lg">
                                <div class="p-5">
                                    <div class="flex items-start gap-4">
                                        <div class="shrink-0">
                                            <div
                                                class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center">
                                                <span class="text-sm font-bold text-gray-500">
                                                    {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span
                                                    class="font-semibold text-gray-900 text-sm">{{ $reply->user->name }}</span>
                                                <span class="text-xs text-gray-400">&middot;</span>
                                                <span class="text-xs text-gray-400"
                                                      title="{{ $reply->created_at->format('d/m/Y H:i') }}">
                                                    {{ $reply->created_at->diffForHumans() }}
                                                </span>
                                                @if($reply->user->isAdmin())
                                                    <span
                                                        class="px-2 py-0.5 text-xs rounded-full bg-indigo-100 text-indigo-700 font-medium">Beheerder</span>
                                                @endif
                                            </div>
                                            <p class="text-gray-700 text-sm whitespace-pre-line leading-relaxed">{{ $reply->body }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-base font-semibold text-gray-800 mb-4">Jouw antwoord</h3>
                    <form method="POST" action="{{ route('forum.replies.store', $thread) }}" class="space-y-4">
                        @csrf
                        <div>
                            <textarea id="body" name="body" rows="5" required maxlength="5000"
                                      placeholder="Schrijf je antwoord hier..."
                                      class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">{{ old('body') }}</textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2"/>
                        </div>
                        <x-primary-button>Antwoord plaatsen</x-primary-button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
