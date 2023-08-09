<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Flag;

class ShowFlags extends Component
{
    public $flags;
    public $listeners = ['flagsRefresh' => 'render'];
    public function render()
    {
        $this->flags = Flag::get()->first();
        return view('livewire.show-flags');
    }
}
