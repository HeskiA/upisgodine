<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Modul;
use App\Models\Odabir;
use App\Models\Predmet;


class AdminRanglista extends Component
{
    public $selectedStudent = null;
    public $moduli;
    public $predmeti;
    public $upisaniModul;
    public $listaUpisanihPredmeta;

    public $users;

    public function render()
    {
        $this->users = User::orderBy('bodovi', 'desc')->get();
        return view('livewire.admin-ranglista', ['users' => $this->users]);
    }

    public function openEnrolledClassesModal($student) : void
    {
        $this->moduli = Modul::all();
        $this->predmeti = Predmet::all();
        $this->upisaniModul = Odabir::where('user_id', $student['id'])
        ->where('predmet_id', null)->where('primljen', true)->get()->first();

        $this->listaUpisanihPredmeta = Odabir::where('user_id', $student['id'])
        ->where('modul_id', null)->where('primljen', true)->orderBy('prioritet', 'asc')->get();
        $this->selectedStudent = $student;
    }

    public function sort() : void 
    {
        $this->users = User::orderBy('bodovi', 'asc')->get();
    }

    public function closeEnrolledClassesModal()
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
