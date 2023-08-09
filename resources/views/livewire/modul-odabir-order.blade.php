<div>
    <head>
        @livewireStyles
        <style>
            .draggable-mirror{
                color: red;
            }
        </style>
        @livewireScripts
    </head>
    @if($flags['odabirModulaZakljucan'])
        <div>Odabir modula je zaključan!</div>
    @else
        <div>Možete mijenjati prioritet modula.</div>
        <ul wire:sortable="enroll" >
            @foreach ($classes as $class)
                @php 
                        $className = App\Http\Livewire\ModulOdabirOrder::getClassName($class->modul_id) 
                @endphp
                <li wire:sortable.item="{{ $class->id }}" wire:key="{{ $class->id }}">
                    <h1 class="bg-gray-200 text-xl rounded w-13 mt-5 p-4" wire:sortable.handle>{{$class->prioritet}}. {{ $className }}</h1>
                </li>
            @endforeach
        </ul>
    @endif

</div>


