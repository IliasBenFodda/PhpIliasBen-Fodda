<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">FAQ bewerken</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.faq.update', $faq) }}" method="POST" class="space-y-4 max-w-2xl">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="question" value="Vraag"/>
                            <x-text-input id="question" name="question" type="text" class="block mt-1 w-full"
                                          :value="old('question', $faq->question)" required maxlength="255"/>
                            @error('question')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-input-label for="answer" value="Antwoord"/>
                            <textarea id="answer" name="answer" rows="4" required
                                      class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('answer', $faq->answer) }}</textarea>
                            @error('answer')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-input-label for="category_id" value="Categorie"/>
                            <select id="category_id" name="category_id"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">— Geen categorie —</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $faq->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit">Opslaan</x-primary-button>
                            <a href="{{ route('faq.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Annuleren</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
