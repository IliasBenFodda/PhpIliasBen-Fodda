<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nieuwe gebruiker
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4 max-w-md">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Naam"/>
                            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
                                          :value="old('name')" required maxlength="255" autofocus/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <div>
                            <x-input-label for="email" value="E-mail"/>
                            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                                          :value="old('email')" required maxlength="255"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <div>
                            <x-input-label for="password" value="Wachtwoord"/>
                            <x-text-input id="password" name="password" type="password" class="block mt-1 w-full"
                                          required minlength="8"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" value="Bevestig wachtwoord"/>
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                          class="block mt-1 w-full" required minlength="8"/>
                        </div>

                        <div>
                            <x-input-label for="role" value="Rol"/>
                            <select id="role" name="role" required
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>Gebruiker</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Beheerder</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Opslaan</x-primary-button>
                            <a href="{{ route('admin.users.index') }}"
                               class="text-sm text-gray-600 hover:text-gray-900">Annuleren</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
