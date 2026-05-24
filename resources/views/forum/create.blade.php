<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nieuw onderwerp aanmaken</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('forum.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" value="Titel"/>
                            <x-text-input id="title" name="title" type="text"
                                          class="block mt-1 w-full"
                                          :value="old('title')"
                                          required maxlength="255" autofocus
                                          placeholder="Waar gaat jouw onderwerp over?"/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                        </div>

                        <div>
                            <x-input-label for="body" value="Bericht"/>
                            <textarea id="body" name="body" rows="8" required maxlength="10000"
                                      placeholder="Beschrijf je onderwerp, vraag of discussiepunt..."
                                      class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('body') }}</textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Plaatsen</x-primary-button>
                            <a href="{{ route('forum.index') }}"
                               class="text-sm text-gray-600 hover:text-gray-900">Annuleren</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
