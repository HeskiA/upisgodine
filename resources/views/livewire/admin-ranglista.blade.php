<div>
    <div>
        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Ime</th>
                    <th wire:click="sort" class="border px-4 py-2">Bodovi</th>
                    <th class="w-1/5 border px-4 py-2">Upisani predmeti i modul</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border px-4 py-2 text-center">
                            <a href="" class="underline">{{ $user->name }}</a>
                        </td>
                        <td class="border px-4 py-2 text-center">{{ $user->bodovi }}</td>
                        <td class="w-1/5 border px-4 py-2 text-center">
                            <x-primary-button wire:click="openEnrolledClassesModal({{ $user }})">
                                PREGLED
                            </x-primary-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($selectedStudent)
        <div wire:click="closeEnrolledClassesModal" class="fixed inset-0 flex items-center justify-center bg-opacity-50 bg-black">
            <div x-on:click.stop="" class="bg-white p-6 rounded-lg w-1/2">
                @if($upisaniModul)
                <div>
                    <table>
                        <tbody class="">
                            <tr class="divide-x divide-gray-400">
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            <div>{{ 'Upisan modul' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-white-900">{{ $upisaniModul->modul()->get()->first()['naziv'] }}</div>
                                </td>
                            </tr>
                        </tbody> <br>
                    </table>
                </div>
                <div>
                    <table class="min-w-full">
                        <tbody class="">
                            @foreach ($listaUpisanihPredmeta as $stavka)
                                <tr class="divide-x divide-gray-400">
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="flex items-center">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                <div>{{ 'Upisan predmet' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-white-900">{{ $stavka->predmet()->get()->first()['naziv'] }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        @if($stavka->semestar() == 'zimski')
                                            <div class="text-sm leading-5 text-white-900">Zimski semestar</div>
                                        @else
                                            <div class="text-sm leading-5 text-white-900">Ljetni semestar</div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> <br>
                    <div>
                        <button wire:click="closeEnrolledClassesModal" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Zatvori</button>
                    </div>
                </div>
            </div>
        </div>
        @else
        <h1>Nema upisanih predmeta.</h1>
        <div class="text-right">
            <button type="button" wire:click="closeEnrolledClassesModal" class="mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Odustani
            </button>
        </div>
        @endif
    @endif
</div>
