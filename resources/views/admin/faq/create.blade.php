<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">FAQ beheer</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Nieuwe categorie</h3>
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-4 items-end">
                        @csrf
                        <div class="flex-1">
                            <x-input-label for="name" value="Categorienaam"/>
                            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
                                          :value="old('name')" required maxlength="255" placeholder="Categorienaam"/>
                            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <x-primary-button type="submit">Toevoegen</x-primary-button>
                    </form>
                    @if (session('success'))
                        <p class="mt-3 text-green-600 text-sm">{{ session('success') }}</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">FAQ toevoegen</h3>
                    <form action="{{ route('admin.faq.store') }}" method="POST" class="space-y-4 max-w-2xl">
                        @csrf

                        <div>
                            <x-input-label for="question" value="Vraag"/>
                            <x-text-input id="question" name="question" type="text" class="block mt-1 w-full"
                                          :value="old('question')" required maxlength="255"/>
                            @error('question')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-input-label for="answer" value="Antwoord"/>
                            <textarea id="answer" name="answer" rows="4" required
                                      class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('answer') }}</textarea>
                            @error('answer')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-input-label for="category_id" value="Categorie"/>
                            <select id="category_id" name="category_id"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">— Geen categorie —</option>
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <x-primary-button type="submit">Opslaan</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
