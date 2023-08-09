<div>
    <head>
        @livewireStyles
        @livewireScripts
    </head>
    <form wire:submit.prevent="enroll" class="mt-5 mb-5">
        @foreach ($classes as $class)
{{--             <input type="checkbox" wire:model="selectedClasses.{{ $class->id }}" id="class_{{ $class->id }}">
 --}}            @php 
                $className = App\Http\Livewire\ClassEnrollment::getClassName($class->id) 
            @endphp
            <label class="mr-14"> {{ $className }}</label>
{{--             <input type="number" wire:model="selectedClasses.{{ $class->id }}" placeholder={{ $class->prioritet }}>
 --}}  
            <select type="number" wire:model="selectedClasses.{{ $class->id }}" style="width:150px;" class="mb-3">
                <option value="{{ $class->prioritet }}" selected>{{ $class->prioritet }}</option>
                @for ($i = 1; $i <= $classesCount; $i++)
                    <option value={{ $i }}>{{ $i }}</option>
                @endfor
            </select>
           <br>
        @endforeach
        <x-primary-button>Spremi</x-primary-button>
        {{-- <button type="submit" class="bg-green-400 m-2 text-black py-2 px-4 rounded hover:bg-blue-600" >Spremi</button> --}}
    </form>
</div>
