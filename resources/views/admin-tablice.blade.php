<x-app-layout>

    <head>
        @livewireStyles
        @livewireScripts
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upravljanje predmetima i modulima') }}
        </h2>
    </x-slot>

    <div>
        <livewire:moduls-table />
    </div>
    
    <div>
        <livewire:predmets-table />
    </div>


</x-app-layout>



