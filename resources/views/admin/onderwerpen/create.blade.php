<x-app-layout>

    <form method="POST" action="{{ route('admin.onderwerpen.store') }}">
        @csrf

        <input name="name" placeholder="Naam onderwerp">

        <button>Opslaan</button>
    </form>

</x-app-layout>
