<x-app-layout>

    <head>
        @livewireStyles
        @livewireScripts
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Status i rezultati') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 pt-6 text-black-900">
                    <strong>{{ __("Status upisa") }}</strong>
                </div>
                <div class="px-6 py-1 text-gray-900">
                    <livewire:show-flags /> <br>
                </div>
            </div> <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900">
                    <strong>{{ __("Rezultati upisa") }}</strong>
                </div>
                <div>
                    <livewire:tablica-rezultata /><br>
                </div>
            </div> <br>
        </div>
    </div>

</x-app-layout>
