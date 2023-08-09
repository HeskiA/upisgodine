<?php

namespace App\Http\Livewire;

use App\Models\Predmet;
use App\Models\Odabir;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClassEnrollment extends Component
{
    public $student;
    public $selectedClasses = [];
    public $enrolledClasses = [];

    public function enroll()
    {
        foreach ($this->selectedClasses as $id => $prioritet) {
            Odabir::where('user_id', Auth::id())->where('predmet_id', $id)->update(['prioritet' => $prioritet]);
        }
        
        session()->flash('message', 'Classes enrolled successfully!');
    }


    public function render()
    {
        $classes = Predmet::get();
        $enrolledClasses = Odabir::where('user_id', Auth::id())->orderBy('prioritet', 'asc')->get();

        if($enrolledClasses->count() === 0)
        {
            for ($i = 0; $i < $classes->count(); $i++)
            {
                Odabir::create([
                    'user_id' => Auth::id(),
                    'predmet_id' => $classes[$i]->id,
                    'prioritet' => $i + 1,
                ]);
            }
            $enrolledClasses = Odabir::where('user_id', Auth::id())->get();
        }
        return view('livewire.class-enrollment', ['classes' => $enrolledClasses, 'classesCount' => $classes->count()]);
    }

    public static function getClassName($predmet_id) : string 
    {
        return Predmet::where('id', $predmet_id)->get()->first()->naziv;
    }
}