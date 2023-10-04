<x-app-layout>

    <head>
        @livewireStyles
        @livewireScripts
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rang lista') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-black-900">
                        <strong>{{ __("Rang lista") }}</strong>
                    </div>
                    <div class="px-6 pb-6 text-gray-900">
                        <livewire:admin-ranglista />
                    </div>
                </div><br>
            </div>
            
        </div>
    </div>

</x-app-layout>



