<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profiel van {{ $user->name }}
            </h2>
            @auth
                @if(auth()->id() === $user->id)
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Profiel bewerken
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                        <div class="shrink-0 flex justify-center sm:justify-start">
                            @if($user->profilePictureUrl())
                                <img src="{{ $user->profilePictureUrl() }}"
                                     alt="Profielfoto van {{ $user->name }}"
                                     class="w-28 h-28 rounded-full object-cover ring-4 ring-indigo-100 shadow-md">
                            @else
                                <div
                                    class="w-28 h-28 rounded-full bg-indigo-100 flex items-center justify-center ring-4 ring-indigo-50 shadow-md">
                                    <span class="text-3xl font-bold text-indigo-600">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 text-center sm:text-left">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>

                            <div class="mt-2 flex flex-wrap items-center justify-center sm:justify-start gap-2">
                                @if($user->isAdmin())
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        Beheerder
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        Lid
                                    </span>
                                @endif
                                <span class="text-sm text-gray-500">
                                    Lid sinds {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($user->about_me || $user->birthday)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 sm:p-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Over deze gebruiker</h3>

                        <dl class="space-y-4">
                            @if($user->birthday)
                                <div class="flex flex-col sm:flex-row sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 sm:w-40 shrink-0">Geboortedatum</dt>
                                    <dd class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') }}
                                    </dd>
                                </div>
                            @endif

                            @if($user->about_me)
                                <div class="flex flex-col sm:flex-row sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 sm:w-40 shrink-0">Over mij</dt>
                                    <dd class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $user->about_me }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500 text-sm">
                        Deze gebruiker heeft nog geen extra profielinformatie ingevuld.
                    </div>
                </div>
            @endif

            @auth
                @if(auth()->id() !== $user->id)
                    <div class="text-center">
                        <a href="{{ route('profile.show', auth()->user()) }}"
                           class="text-sm text-indigo-600 hover:text-indigo-800">
                            &larr; Terug naar mijn profiel
                        </a>
                    </div>
                @endif
            @endauth

        </div>
    </div>
</x-app-layout>
