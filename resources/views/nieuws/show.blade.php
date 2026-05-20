<x-app-layout>

    <h1>{{ $nieuws->title }}</h1>

    <img src="{{ asset('storage/' . $nieuws->image) }}" width="300">

    <p>{{ $nieuws->publication_date->format('d/m/Y') }}</p>

    <p>{{ $nieuws->content }}</p>

    <h3>Onderwerpen</h3>

    <ul>
        @foreach($nieuws->onderwerpen as $onderwerp)
            <li>{{ $onderwerp->name }}</li>
        @endforeach
    </ul>

</x-app-layout>
