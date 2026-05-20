<x-app-layout>

    <h1>Onderwerpen</h1>

    <a href="{{ route('admin.onderwerpen.create') }}">Nieuw onderwerp</a>

    @foreach($onderwerpen as $onderwerp)

        <div>
            {{ $onderwerp->name }}

            <a href="{{ route('admin.onderwerpen.edit', $onderwerp) }}">Edit</a>

            <form method="POST" action="{{ route('admin.onderwerpen.destroy', $onderwerp) }}">
                @csrf
                @method('DELETE')

                <button>Delete</button>
            </form>
        </div>

    @endforeach

</x-app-layout>
