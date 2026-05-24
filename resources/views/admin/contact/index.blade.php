<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Contactberichten
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    @if($messages->isEmpty())
                        <p class="text-gray-500">Er zijn nog geen contactberichten.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Naam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bericht</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Datum</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acties</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($messages as $message)
                                <tr class="{{ $message->read ? '' : 'bg-indigo-50' }}">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium {{ $message->read ? 'text-gray-700' : 'text-gray-900' }}">
                                        {{ $message->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        <a href="mailto:{{ $message->email }}"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            {{ $message->email }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700 max-w-md">
                                        <p class="line-clamp-2 whitespace-pre-wrap">{{ $message->message }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                                        {{ $message->created_at->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($message->read)
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">Gelezen</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-indigo-100 text-indigo-800">Nieuw</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                        @unless($message->read)
                                            <form method="POST" action="{{ route('admin.contact.markRead', $message) }}"
                                                  class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="text-indigo-600 hover:text-indigo-900 text-sm">
                                                    Markeer gelezen
                                                </button>
                                            </form>
                                        @endunless
                                        <form method="POST" action="{{ route('admin.contact.destroy', $message) }}"
                                              class="inline"
                                              onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                                Verwijderen
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $messages->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
