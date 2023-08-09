<x-app-layout>

    <head>
        @livewireStyles
        @livewireScripts
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-black-900">
                        <strong>{{ __("Zaključaj i izračunaj rang listu") }}</strong>
                    </div>
                    <div class="px-6 pb-6 text-gray-900">
                        <livewire:zakljucaj-izracunaj-upis />
                    </div>
                </div><br>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-black-900">
                        <strong>{{ __("Tablica korisnika") }}</strong>
                    </div>
                    <div class="pb-2 px-6 text-gray-900">
                        <livewire:admin-table />
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</x-app-layout>



