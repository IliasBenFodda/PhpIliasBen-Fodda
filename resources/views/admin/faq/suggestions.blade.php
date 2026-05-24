<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            FAQ-voorstellen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">{{ session('error') }}</div>
            @endif

            @if($suggestions->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-500">Er zijn nog geen voorstellen.</div>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($suggestions as $suggestion)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-start justify-between gap-4 mb-3">
                                    <div>
                                        <p class="font-semibold text-gray-800 text-lg">{{ $suggestion->question }}</p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Ingediend door
                                            <span class="font-medium text-gray-700">{{ $suggestion->user->name }}</span>
                                            op {{ $suggestion->created_at->format('d-m-Y H:i') }}
                                            @if($suggestion->category)
                                                &middot; Categorie: <span
                                                class="font-medium text-gray-700">{{ $suggestion->category->name }}</span>
                                            @else
                                                &middot; <span class="italic">Geen categorie</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="shrink-0">
                                        @if($suggestion->status === 'pending')
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">In behandeling</span>
                                        @elseif($suggestion->status === 'approved')
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Goedgekeurd</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Afgewezen</span>
                                        @endif
                                    </div>
                                </div>

                                @if($suggestion->isPending())
                                    <div class="border-t pt-4 mt-2 space-y-4">
                                        {{-- Approve with answer --}}
                                        <form action="{{ route('admin.faq.suggestions.approve', $suggestion) }}"
                                              method="POST" class="space-y-3">
                                            @csrf
                                            @method('PATCH')
                                            <div>
                                                <x-input-label for="answer_{{ $suggestion->id }}"
                                                               value="Antwoord (verplicht om goed te keuren)"/>
                                                <textarea id="answer_{{ $suggestion->id }}" name="answer" rows="3"
                                                          required minlength="5"
                                                          class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                          placeholder="Formuleer hier een duidelijk antwoord...">{{ old('answer') }}</textarea>
                                                @error('answer')
                                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="flex gap-3">
                                                <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition">
                                                    Goedkeuren &amp; publiceren
                                                </button>
                                            </div>
                                        </form>

                                        {{-- Reject --}}
                                        <form action="{{ route('admin.faq.suggestions.reject', $suggestion) }}"
                                              method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    onclick="return confirm('Weet je zeker dat je dit voorstel wilt afwijzen?')"
                                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                                                Afwijzen
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $suggestions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
