<x-app-layout>

    <head>
        @livewireStyles
        @livewireScripts
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Predmeti') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded px-12 py-8">
                <a href="{{ route('predmets.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-auto">Dodaj predmet</a> <br> <br>
                <table class="w-full border">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Naziv</th>
                            <th class="border px-4 py-2">Kapacitet</th>
                            <th class="border px-4 py-2">Popunjeno</th>
                            <th class="border px-4 py-2">Stvoren</th>
                            <th class="border px-4 py-2">Ažuriran</th>
                            <th class="border px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($predmets as $predmet)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $predmet->id }}</td>
                                <td class="border px-4 py-2 text-center">{{ $predmet->naziv }}</td>
                                <td class="border px-4 py-2 text-center">{{ $predmet->kapacitet }}</td>
                                <td class="border px-4 py-2 text-center">{{ $predmet->popunjeno }}</td>
                                <td class="border px-4 py-2 text-center">{{ $predmet->created_at }}</td>
                                <td class="border px-4 py-2 text-center">{{ $predmet->updated_at }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="{{ route('predmets.edit', $predmet->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Uredi</a>
                                    <form action="{{ route('predmets.destroy', $predmet->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Potvrdite brisanje predmeta {{ $predmet->naziv}}')">Izbriši</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

</x-app-layout>



