<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">FAQ</h2>
            @auth
                @unless(auth()->user()->isAdmin())
                    <a href="{{ route('faq.suggestions.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                        Vraag voorstellen
                    </a>
                @endunless
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif

            @foreach ($categories as $category)
                <div class="mb-8">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="flex items-center gap-3 mb-4">
                                <h2 class="text-xl font-semibold text-blue-600">{{ $category->name }}</h2>
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="text-gray-500 hover:text-indigo-600" title="Categorie bewerken">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-600">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <h2 class="text-xl font-semibold text-blue-600 mb-4">{{ $category->name }}</h2>
                        @endif
                    @endauth

                    @guest
                        <h2 class="text-xl font-semibold text-blue-600 mb-4">{{ $category->name }}</h2>
                    @endguest

                    @forelse ($category->faqs as $faq)
                        <div class="bg-white rounded-lg border p-4 mb-3 shadow-sm">
                            @auth
                                @if(auth()->user()->isAdmin())
                                    <div class="flex gap-6 justify-end mb-2">
                                        <a href="{{ route('admin.faq.edit', $faq->id) }}"
                                           class="text-gray-500 hover:text-indigo-600">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-600">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth

                            <p class="font-semibold text-gray-800">{{ $faq->question }}</p>

                            @if ($faq->answer)
                                <p class="text-gray-600 mt-2">{{ $faq->answer }}</p>
                            @else
                                <p class="text-gray-400 mt-2 italic">Nog geen antwoord.</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-400 italic">Geen vragen in deze categorie.</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
