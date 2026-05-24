<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            FAQ-vraag voorstellen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-6 text-gray-600">
                        Heb je een vraag die je graag in de FAQ zou zien? Stel hem hieronder voor.
                        Een admin beoordeelt je voorstel en voegt het toe als het wordt goedgekeurd.
                    </p>

                    <form action="{{ route('faq.suggestions.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="question" value="Vraag"/>
                            <x-text-input id="question" name="question" type="text" class="block mt-1 w-full"
                                          :value="old('question')" required maxlength="255"
                                          placeholder="Stel hier je vraag..."/>
                            <x-input-error :messages="$errors->get('question')" class="mt-2"/>
                        </div>

                        <div>
                            <x-input-label for="category_id" value="Categorie (optioneel)"/>
                            <select id="category_id" name="category_id"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">— Geen categorie —</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Voorstel indienen</x-primary-button>
                            <a href="{{ route('faq.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Annuleren
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
