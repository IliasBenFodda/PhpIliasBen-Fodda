<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Nieuwe chat starten</h1>

        <form method="POST" action="{{ route('conversations.store') }}" class="bg-white rounded-lg shadow p-6">
            @csrf
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Kies een gebruiker</label>
                <select id="user_id" name="user_id" required
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">-- Selecteer een gebruiker --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <x-primary-button>Chat starten</x-primary-button>
                <a href="{{ route('conversations.index') }}"
                   class="text-sm text-gray-600 hover:text-gray-900">Annuleren</a>
            </div>
        </form>
    </div>
</x-app-layout>
