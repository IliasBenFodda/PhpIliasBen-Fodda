<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nieuws</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($nieuws as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($item->image)
                            <img src="{{ storage_public_url($item->image) }}" alt="{{ $item->title }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">Geen
                                afbeelding
                            </div>
                        @endif
                        <div class="p-4">
                            <p class="text-sm text-gray-500">{{ $item->publication_date->format('d/m/Y') }}</p>
                            <h2 class="text-lg font-semibold text-gray-800 mt-1">{{ $item->title }}</h2>
                            <a href="{{ route('nieuws.show', $item) }}"
                               class="inline-block mt-3 text-indigo-600 hover:text-indigo-800 text-sm font-medium">Lees
                                meer &rarr;</a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full">Er is nog geen nieuws beschikbaar.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
