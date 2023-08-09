<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Modul;


class ModulsTable extends Component
{
    public $moduls;

    public $dodaj = false;
    public $azuriraj = false;

    public $nazivNovogModula;
    public $kapacitetNovogModula;
    public $editedModul;
    public $greska;

    public $rules = [
        'editedModul.naziv' => 'required',
        'editedModul.kapacitet' => 'required',
    ];

    public function render()
    {
        $this->moduls = Modul::get();
        return view('livewire.moduls-table');
    }

    public function otvoriModal()
    {
        $this->dodaj = true;
    }

    public function zatvoriModal()
    {
        $this->dodaj = false;
        $this->greska = "";
    }

    public function otvoriUpdateModal($idModula)
    {
        $this->editedModul = Modul::where('id', $idModula)->get()->first();
        $this->azuriraj = true;
    }

    public function zatvoriUpdateModal()
    {
        $this->azuriraj = false;
        $this->greska = "";
    }

    public function spremi()
    {
        if($this->verify())
        {
            Modul::create(['naziv' => $this->nazivNovogModula, 'kapacitet' => $this->kapacitetNovogModula]);
            $this->dodaj = false;
        }
    }

    public function azuriraj()
    {
        if($this->verifyUpdate())
        {
            $this->editedModul->save();
            $this->azuriraj = false;
        }
    }

    public function delete($id)
    {
        Modul::where('id', $id)->delete();
    }

    public function verifyUpdate()
    {
        $this->greska = "";
        if(!$this->editedModul->naziv)
        {
            $this->greska = $this->greska . "Naziv ne smije biti prazan!\n";
        }

        if(Modul::where('naziv', $this->editedModul->naziv)->where('id', '!=', $this->editedModul->id)->exists())
        {
            $this->greska = $this->greska . "Modul s ovim nazivom već postoji!\n";
        }

        if(!$this->editedModul->kapacitet)
        {
            $this->greska = $this->greska . "Definirajte kapacitet modula!\n";
        }

        if($this->greska)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function verify()
    {
        $this->greska = "";
        if(!$this->nazivNovogModula)
        {
            $this->greska = $this->greska . "Naziv ne smije biti prazan!\n";
        }

        if(Modul::where('naziv', $this->nazivNovogModula)->exists())
        {
            $this->greska = $this->greska . "Modul s ovim nazivom već postoji!\n";
        }

        if(!$this->kapacitetNovogModula)
        {
            $this->greska = $this->greska . "Definirajte kapacitet modula!\n";
        }

        if($this->greska)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}
