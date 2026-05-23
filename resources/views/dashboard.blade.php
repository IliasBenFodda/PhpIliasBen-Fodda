<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">{{ __("You're logged in!") }}</div>
            </div>

            @if(auth()->user()->isAdmin())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Beheer</h3>
                        <div class="grid sm:grid-cols-3 gap-4">
                            <a href="{{ route('admin.nieuws.index') }}"
                               class="block p-4 border rounded-lg hover:bg-gray-50">
                                <p class="font-medium text-gray-800">Nieuws beheer</p>
                                <p class="text-sm text-gray-500 mt-1">Nieuwsitems beheren</p>
                            </a>
                            <a href="{{ route('admin.faq.create') }}"
                               class="block p-4 border rounded-lg hover:bg-gray-50">
                                <p class="font-medium text-gray-800">FAQ beheer</p>
                                <p class="text-sm text-gray-500 mt-1">Vragen en categorieën beheren</p>
                            </a>
                            <a href="{{ route('admin.users.index') }}"
                               class="block p-4 border rounded-lg hover:bg-gray-50">
                                <p class="font-medium text-gray-800">Gebruikers</p>
                                <p class="text-sm text-gray-500 mt-1">Gebruikers beheren</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
