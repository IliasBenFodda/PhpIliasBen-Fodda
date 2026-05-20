<x-app-layout>

    <form method="POST" action="{{ route('admin.onderwerpen.update', $onderwerp) }}">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $onderwerp->name }}">

        <button>Update</button>
    </form>

</x-app-layout>
