<?php

namespace App\Http\Livewire;

use App\Models\Modul;
use App\Models\Odabir;
use App\Models\Flag;
use Error;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ModulOdabirOrder extends Component
{
    public $student;
    public $flags;
    public $selectedClasses = [];
    public $enrolledClasses = [];

    public function enroll($items)
    {
        foreach ($items as $item) {
            Odabir::where('user_id', Auth::id())->where('id', $item['value'])->update(['prioritet' => $item['order']]);
        }
    }


    public function render()
    {
        $classes = Modul::get();
        $this->flags = Flag::get()->first();
        $enrolledClasses = Odabir::where('user_id', Auth::id())
        ->where('predmet_id', NULL)->orderBy('prioritet', 'asc')->get();

        if($enrolledClasses->count() === 0)
        {
            for ($i = 0; $i < $classes->count(); $i++)
            {
                Odabir::create([
                    'user_id' => Auth::id(),
                    'modul_id' => $classes[$i]->id,
                    'prioritet' => $i + 1,
                ]);
            }
            $enrolledClasses = Odabir::where('user_id', Auth::id())->where('predmet_id', NULL)->get();
        }
        return view('livewire.modul-odabir-order', ['classes' => $enrolledClasses, 'classesCount' => $classes->count()]);
    }

    public function getClassName($predmet_id) : string 
    {
        return Modul::where('id', $predmet_id)->get()->first()->naziv;
    }
}