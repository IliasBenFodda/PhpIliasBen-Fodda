<x-app-layout>

    <form method="POST" action="{{ route('admin.onderwerpen.store') }}">
        @csrf

        <input name="name" placeholder="Naam onderwerp" required maxlength="255">

        <button>Opslaan</button>
    </form>

</x-app-layout>
