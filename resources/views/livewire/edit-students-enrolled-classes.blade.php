<div>
@if($selectedStudent)
<div wire:click="close" class="fixed inset-0 flex items-center justify-center bg-opacity-50 bg-black">
    <div x-on:click.stop="" class="bg-white p-6 rounded-lg w-1/2">
        <h3 class="text-lg font-medium mb-4">Uređivanje upisanih predmeta za studenta {{ $selectedStudent['name']}}</h3>
        @if($upisaniModul || $listaUpisanihPredmeta->count() > 0)
        <form wire:submit.prevent="updateStudent">
            <table class="min-w-full">
                <tbody class="">
                    <tr class="divide-x divide-gray-400">
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="flex items-center">
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    <div>{{ 'Upisani modul' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-white-900">{{ $this->getUpisaniModulName() }}</div>
                            <select type="number" wire:model="updateModul" style="width:100%;" class="mb-3">
                                <option value="{{ $this->getUpisaniModulId() }}" selected hidden>{{ $this->getUpisaniModulName()  }}</option>
                                @foreach ($moduli as $modul)
                                        <option value={{ $modul['id'] }}>{{ $modul['naziv'] }}</option>
                                    @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="min-w-full">
                <tbody class="">
                    @foreach ($listaUpisanihPredmeta as $stavka)
                        <tr class="divide-x divide-gray-400">
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        <div>{{ 'Upisani predmet' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="text-sm leading-5 text-white-900">{{ $stavka->predmet()->get()->first()['naziv'] }}</div>
                                <select type="number" wire:model="updateOdabirs.{{ $stavka->id }}" style="width:100%;" class="mb-3">
                                    <option value="{{ $stavka->predmet()->get()->first()['id'] }}" selected hidden>{{ $stavka->predmet()->get()->first()['naziv'] }}</option>
                                    @foreach ($predmeti as $predmet)
                                            <option value={{ $predmet['id'] }}>{{ $predmet['naziv'] }}</option>
                                        @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                <button type="button" wire:click="close" class="mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Odustani
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Spremi
                </button>
            </div>
        </form>
    @else
        <h1>Nema upisanih predmeta.</h1>
        <div class="text-right">
            <button type="button" wire:click="close" class="mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Odustani
            </button>
        </div>
    @endif
    </div>
</div>
@endif
</div>