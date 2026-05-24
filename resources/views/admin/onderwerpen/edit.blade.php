<x-app-layout>

    <form method="POST" action="{{ route('admin.onderwerpen.update', $onderwerp) }}">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $onderwerp->name }}" required maxlength="255">

        <button>Update</button>
    </form>

</x-app-layout>
