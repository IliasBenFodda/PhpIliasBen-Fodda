<x-app-layout>

    <form method="POST" action="{{ route('admin.nieuws.store') }}" enctype="multipart/form-data">
        @csrf

        <input name="title" placeholder="Titel">

        <textarea name="content"></textarea>

        <input type="date" name="publication_date">

        <input type="file" name="image">

        <h3>Onderwerpen</h3>

        @foreach($onderwerpen as $onderwerp)
            <label>
                <input type="checkbox" name="onderwerpen[]" value="{{ $onderwerp->id }}">
                {{ $onderwerp->name }}
            </label>
        @endforeach

        <button>Opslaan</button>
    </form>

</x-app-layout>
