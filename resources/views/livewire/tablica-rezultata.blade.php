<div>
    @if($flags['rezultatiDostupni'])
        <div>
            <table class="min-w-full">
                <tbody class="">
                    @foreach ($listaUpisanih as $stavka)
                        <tr class="divide-x divide-gray-400">
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        <div>{{ 'Upisani modul' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="text-sm leading-5 text-white-900">{{ $stavka->modul()->get()->first()['naziv'] }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> <br>
        </div>
        <div>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> <br>
        </div>
    @else
        <div class="px-6 py-1 text-gray-900">
            <h2>Rezultati još nisu dostupni.</h2>
        </div>
    @endif
    
</div>

