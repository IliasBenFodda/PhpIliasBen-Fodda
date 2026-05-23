<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Contact
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
                    @endif

                    <p class="mb-6 text-gray-600">Heb je een vraag of opmerking? Stuur ons een bericht.</p>

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Naam"/>
                            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
                                          :value="old('name')" required minlength="2" maxlength="255"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <div>
                            <x-input-label for="email" value="E-mail"/>
                            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                                          :value="old('email')" required maxlength="255"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <div>
                            <x-input-label for="message" value="Bericht"/>
                            <textarea id="message" name="message" rows="5" required minlength="10"
                                      class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('message') }}</textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2"/>
                        </div>

                        <x-primary-button>Versturen</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
