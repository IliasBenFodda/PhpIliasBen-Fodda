<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categorie bewerken
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}"
                          class="space-y-4 max-w-md">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" value="Naam"/>
                            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
                                          :value="old('name', $category->name)" required maxlength="255" autofocus/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Opslaan</x-primary-button>
                            <a href="{{ route('faq.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Annuleren</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
