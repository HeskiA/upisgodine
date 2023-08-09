<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded px-12 py-8">
            <div class="text-black-900">
                <strong>{{ __("Moduli") }}</strong>
            </div><br>
            <button wire:click="otvoriModal" class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">DODAJ MODUL</button> <br> <br>
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
                    @foreach($moduls as $modul)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $modul->id }}</td>
                            <td class="border px-4 py-2 text-center">{{ $modul->naziv }}</td>
                            <td class="border px-4 py-2 text-center">{{ $modul->kapacitet }}</td>
                            <td class="border px-4 py-2 text-center">{{ $modul->popunjeno }}</td>
                            <td class="border px-4 py-2 text-center">{{ $modul->created_at }}</td>
                            <td class="border px-4 py-2 text-center">{{ $modul->updated_at }}</td>
                            <td class="border px-4 py-2 text-center">
                                <button wire:click="otvoriUpdateModal({{ $modul->id }})" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Uredi</button>
                                <button wire:click="delete({{ $modul->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Izbriši</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>

    @if ($dodaj)
        <div wire:click="zatvoriModal" class="fixed inset-0 flex items-center justify-center bg-opacity-50 bg-black">
            <div x-on:click.stop="" class="bg-white p-6 rounded-lg w-1/2">
                <h3 class="text-lg font-medium mb-4">Dodavanje modula</h3>

                <div>
                    <input type="text" id="naziv" wire:model="nazivNovogModula" placeholder="Naziv modula" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                    <input type="number" id="kapacitet" wire:model="kapacitetNovogModula" placeholder="Kapacitet" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                    <h3 class="text-red-400">{{ $greska }}</h3>
                </div>

                <div class="text-right">
                    <button type="button" wire:click="zatvoriModal" class="mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Odustani
                    </button>
                    <button type="submit" wire:click="spremi" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Spremi
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if ($azuriraj)
        <div wire:click="zatvoriUpdateModal" class="fixed inset-0 flex items-center justify-center bg-opacity-50 bg-black">
            <div x-on:click.stop="" class="bg-white p-6 rounded-lg w-1/2">
                <h3 class="text-lg font-medium mb-4">Uređivanje modula</h3>
            <div>
                <input type="text" id="naziv" wire:model="editedModul.naziv" placeholder="Naziv modula" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                <input type="number" id="kapacitet" wire:model="editedModul.kapacitet" placeholder="Kapacitet" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                <h3 class="text-red-400">{{ $greska }}</h3>
            </div>

                <div class="text-right">
                    <button type="button" wire:click="zatvoriUpdateModal" class="mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                       Odustani
                    </button>
                    <button type="submit" wire:click="azuriraj" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Spremi
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>