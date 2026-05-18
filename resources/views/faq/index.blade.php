<x-app-layout>
    @foreach ($categories as $category)
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-blue-600 mb-4">
                {{ $category->name }}
            </h2>

            @forelse ($category->faqs as $faq)
                <div class="bg-white rounded-lg border p-4 mb-3">
                    <div class="flex gap-6 justify-end">
                        {{-- Edit form --}}
                        <a href="{{route("admin.faq.edit", $faq->id)}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        {{-- Delete form --}}
                        <form action="{{route("admin.faq.destroy",$faq->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>

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
</x-app-layout>
