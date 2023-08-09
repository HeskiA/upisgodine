<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Odabir;
use App\Models\Predmet;
use App\Models\Modul;
use Livewire\WithPagination;
use Exception;

class AdminTable extends Component
{
    use WithPagination;

    //public $students;
    public $selectedStudent = null;
    public $listaUpisanihPredmeta;
    public $upisaniModul;
    public $predmeti;
    public $moduli;

    public $updateOdabirs = [];
    public $updateModul;
    public function render()
    {
        $students = User::orderBy('name', 'asc')->paginate(4);
        $this->predmeti = Predmet::get();
        $this->moduli = Modul::get();
        return view('livewire.admin-table', ['students' => $students]);
    }

    public function otvoriModal($student)
    {
        $this->selectedStudent = $student;
        $this->upisaniModul = Odabir::where('user_id', $this->selectedStudent['id'])
            ->where('predmet_id', null)->where('primljen', true)->get()->first();
        $this->listaUpisanihPredmeta = Odabir::where('user_id', $this->selectedStudent['id'])
            ->where('modul_id', null)->where('primljen', true)->orderBy('prioritet', 'asc')->get();
    }

    public function updateStudent()
    {
        Odabir::where('id', $this->upisaniModul->id)->update(['modul_id' => $this->updateModul]);
        foreach($this->updateOdabirs as $id => $el)
        {
            Odabir::where('id', $id)->update(['predmet_id' => $el]);
        }
        $this->selectedStudent = null;
    }

    public function zatvoriModal()
    {
        $this->selectedStudent = null;
    }
    
    public function getUpisaniModulName()
    {
        if($this->upisaniModul)
        {
            return $this->upisaniModul->modul()->get()->first()->naziv;
        }
        else
        {
            return " ";
        }
    }

    public function getUpisaniModulId()
    {
        if($this->upisaniModul)
        {
            return $this->upisaniModul->modul()->get()->first()->id;
        }
        else
        {
            return " ";
        }
    }

}
