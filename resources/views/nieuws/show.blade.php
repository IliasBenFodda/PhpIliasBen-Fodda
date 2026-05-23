<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $nieuws->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($nieuws->image)
                    <img src="{{ storage_public_url($nieuws->image) }}" alt="{{ $nieuws->title }}"
                         class="w-full max-h-96 object-cover">
                @endif
                <div class="p-6">
                    <p class="text-sm text-gray-500 mb-4">{{ $nieuws->publication_date->format('d/m/Y') }}</p>
                    <div class="prose text-gray-700 whitespace-pre-line">{{ $nieuws->content }}</div>
                    @if($nieuws->onderwerpen->isNotEmpty())
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Onderwerpen</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($nieuws->onderwerpen as $onderwerp)
                                    <span
                                        class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm rounded-full">{{ $onderwerp->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <a href="{{ route('nieuws.index') }}"
                       class="inline-block mt-6 text-indigo-600 hover:text-indigo-800 text-sm">&larr; Terug naar
                        nieuws</a>
                </div>
            </article>
        </div>
    </div>
</x-app-layout>
