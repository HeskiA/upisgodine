<?php

namespace App\Http\Livewire;

use App\Models\Predmet;
use App\Models\Odabir;
use App\Models\Flag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OdabirOrder extends Component
{
    public $student;
    public $selectedClasses = [];
    public $enrolledClasses = [];
    public $flags;
    public $semestar;

    public function enroll($items)
    {
        foreach ($items as $item) {
            Odabir::where('user_id', Auth::id())->where('id', $item['value'])->update(['prioritet' => $item['order']]);
        }
        
        session()->flash('message', 'Classes enrolled successfully!');
    }


    public function render()
    {
        $classes = Predmet::where('semestar', $this->semestar)->get();
        $allEnrolledClasses = Odabir::where('user_id', Auth::id())
        ->where('modul_id', NULL)->orderBy('prioritet', 'asc')->get();

        $enrolledClasses = $this->filterBySemestar($allEnrolledClasses);


        $this->flags = Flag::get()->first();

        if(count($enrolledClasses) === 0)
        {
            for ($i = 0; $i < $classes->count(); $i++)
            {
                Odabir::create([
                    'user_id' => Auth::id(),
                    'predmet_id' => $classes[$i]->id,
                    'prioritet' => $i + 1,
                ]);
            }
            $enrolledClasses = Odabir::where('user_id', Auth::id())->where('modul_id', NULL)->get();
            $enrolledClasses = $this->filterBySemestar($enrolledClasses);
        }

        return view('livewire.odabir-order', ['classes' => $enrolledClasses, 'classesCount' => $classes->count()]);
    }

    public function getClassName($predmet_id) : string 
    {
        return Predmet::where('id', $predmet_id)->get()->first()->naziv;
    }

    public function filterBySemestar($allEnrolledClasses)
    {
        $enrolledClasses = [];
        foreach($allEnrolledClasses as $class)
        {
            if($class->semestar() == $this->semestar)
            {
                array_push($enrolledClasses, $class);
            }
        }
        return $enrolledClasses;
    }
}