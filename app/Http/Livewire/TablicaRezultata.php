<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Odabir;
use App\Models\Flag;
use Illuminate\Support\Facades\Auth;

class TablicaRezultata extends Component
{
    public $listaUpisanih;
    public $listaUpisanihPredmeta;
    public $flags;
    public $listeners = ['rezultatiRefresh' => 'render'];
    public function render()
    {
        $this->flags = Flag::get()->first();
        $this->listaUpisanih = Odabir::where('user_id', Auth::id())
            ->where('predmet_id', null)->where('primljen', true)->get();
        $this->listaUpisanihPredmeta = Odabir::where('user_id', Auth::id())
            ->where('modul_id', null)->where('primljen', true)->orderBy('prioritet', 'asc')->get();
        return view('livewire.tablica-rezultata');
    }
}
