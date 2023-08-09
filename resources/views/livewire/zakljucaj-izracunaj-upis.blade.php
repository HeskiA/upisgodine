<div>
    @if($flags['odabirModulaZakljucan'])
        <x-success-button wire:click="otkModul">{{ __('Otključaj odabir modula') }}</x-success-button>
    @else
        <x-danger-button wire:click="zakModul">{{ __('Zaključaj odabir modula') }}</x-danger-button>
    @endif
    @if($flags['odabirPredmetaZakljucan'])
        <x-success-button wire:click="otkPredmet">{{ __('Otključaj odabir predmeta') }}</x-success-button>
    @else
        <x-danger-button wire:click="zakPredmet">{{ __('Zaključaj odabir predmeta') }}</x-danger-button>
    @endif
    @if($flags['rezultatiDostupni'])
        <x-danger-button wire:click="resetiraj">{{ __('Resetiraj upis') }}</x-danger-button>
    @else
        <x-primary-button wire:click="izracunaj">{{ __('Izračunaj') }}</x-primary-button>
    @endif
</div>
