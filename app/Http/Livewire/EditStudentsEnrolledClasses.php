<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Odabir;

use function Symfony\Component\String\b;

class EditStudentsEnrolledClasses extends Component
{
    public $selectedStudent;
    public $upisaniModul;
    public $listaUpisanihPredmeta;

    protected $listeners = ['rerenderModal' => '$refresh'];

    public function render()
    {
        if($this->selectedStudent)
        {
            $this->upisaniModul = Odabir::where('user_id', $this->selectedStudent['id'])
            ->where('predmet_id', null)->where('primljen', true)->get()->first();
    
            $this->listaUpisanihPredmeta = Odabir::where('user_id', $this->selectedStudent['id'])
            ->where('modul_id', null)->where('primljen', true)->orderBy('prioritet', 'asc')->get();
        }

        return view('livewire.edit-students-enrolled-classes');
    }

    public function close() : void
    {
        $this->selectedStudent = null;
    }

}
