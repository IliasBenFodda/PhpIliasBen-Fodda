<x-app-layout>

    <h1>Nieuws beheer</h1>

    <a href="{{ route('admin.nieuws.create') }}">Nieuw item</a>

    @foreach($nieuws as $item)

        <div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px;">

            <h2>{{ $item->title }}</h2>

            <a href="{{ route('admin.nieuws.edit', $item) }}">
                Edit
            </a>

            <form method="POST"
                  action="{{ route('admin.nieuws.destroy', $item) }}"
                  style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="submit">
                    Delete
                </button>
            </form>

        </div>

    @endforeach

</x-app-layout><?php
