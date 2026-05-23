<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nieuw nieuwsitem</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.nieuws.store') }}" enctype="multipart/form-data"
                      class="space-y-4 max-w-2xl">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Titel"/>
                        <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" required
                                      maxlength="255"/>
                    </div>

                    <div>
                        <x-input-label for="content" value="Inhoud"/>
                        <textarea id="content" name="content" rows="6" required
                                  class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div>
                        <x-input-label for="publication_date" value="Publicatiedatum"/>
                        <x-text-input id="publication_date" name="publication_date" type="date"
                                      class="block mt-1 w-full" required/>
                    </div>

                    <div>
                        <x-input-label for="image" value="Afbeelding"/>
                        <input id="image" name="image" type="file" class="block mt-1 w-full"/>
                    </div>

                    <div>
                        <x-input-label value="Onderwerpen"/>
                        <div class="mt-2 space-y-2">
                            @foreach($onderwerpen as $onderwerp)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="onderwerpen[]" value="{{ $onderwerp->id }}">
                                    {{ $onderwerp->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <x-primary-button>Opslaan</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
