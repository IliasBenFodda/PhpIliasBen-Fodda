<x-app-layout>

    @foreach($nieuws as $item)

        <a href="{{ route('nieuws.show', $item) }}">
            <h2>{{ $item->title }}</h2>

            <img src="{{ asset('storage/' . $item->image) }}" width="150">

            <p>{{ $item->publication_date->format('d/m/Y') }}</p>
        </a>

    @endforeach

</x-app-layout>
