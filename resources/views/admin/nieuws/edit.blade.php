<x-app-layout>

    <form method="POST" action="{{ route('admin.nieuws.update', $nieuws) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input name="title" value="{{ $nieuws->title }}">

        <textarea name="content">{{ $nieuws->content }}</textarea>

        <input type="date" name="publication_date" value="{{ $nieuws->publication_date->format('Y-m-d') }}">

        <input type="file" name="image">

        <h3>Onderwerpen</h3>

        @foreach($onderwerpen as $onderwerp)
            <label>
                <input type="checkbox"
                       name="onderwerpen[]"
                       value="{{ $onderwerp->id }}"
                    {{ $nieuws->onderwerpen->contains($onderwerp) ? 'checked' : '' }}>
                {{ $onderwerp->name }}
            </label>
        @endforeach

        <button>Update</button>
    </form>

</x-app-layout>
