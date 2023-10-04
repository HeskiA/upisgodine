<div>
    <table class="min-w-full">
        <tbody class="bg-white">
            @foreach ($students as $student)
                <tr class="divide-x divide-gray-200">
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm leading-5 font-medium text-gray-900">{{ $student['name'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="text-sm leading-5 text-gray-900">{{ $student['email'] }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                        <x-primary-button wire:click="otvoriModal( {{ $student}} )">
                            UPISANI PREDMETI
                        </x-primary-button>
                        <x-primary-button wire:click="openEditDataModal( {{ $student}} )">
                            PODACI
                        </x-primary-button>
                        <x-danger-button wire:click="otvoriModal( {{ $student}} )">
                            BRISANJE
                        </x-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table><br>

    <div>
        {{ $students->links() }}
    </div>

    @if ($selectedStudent)
        <div wire:click="zatvoriModal" class="fixed inset-0 flex items-center justify-center bg-opacity-50 bg-black">
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
                        <button type="button" wire:click="zatvoriModal" class="mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
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
                    <button type="button" wire:click="zatvoriModal" class="mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Odustani
                    </button>
                </div>
            @endif
            </div>
        </div>
    @endif

    @if ($editData)
    <div wire:click="closeEditDataModal" class="fixed inset-0 flex items-center justify-center bg-opacity-50 bg-black">
        <div x-on:click.stop="" class="bg-white p-6 rounded-lg w-1/2">
            <h3 class="text-lg font-medium mb-4">Uređivanje podataka o studentu {{ $editData->name }} </h3>
            <form wire:submit.prevent="updateStudentData">
                <div>
                    ECTS: <input type="number" id="ects" wire:model="editData.ects" placeholder="ECTS" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                    Prosjek: <input type="number" step="any" id="prosjek" wire:model="editData.prosjek" placeholder="ECTS prošle godine" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                    Godine studiranja: <input type="number" id="godstud" wire:model="editData.godstud" placeholder="Godine studiranja" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                    ECTS prošle godine: <input type="number" id="ects_pgod" wire:model="editData.ects_pgod" placeholder="ECTS prošle godine" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                    Prosjek prošle godine: <input type="number" step="any" id="prosjek_pgod" wire:model="editData.prosjek_pgod" placeholder="ECTS prošle godine" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                </div>
                <div class="text-right">
                    <button type="button" wire:click="closeEditDataModal" class="mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Odustani
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Spremi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
</div>
