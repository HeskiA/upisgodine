<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Predmet;


class PredmetsTable extends Component
{
    public $predmets;

    public $dodaj = false;
    public $azuriraj = false;

    public $nazivNovogPredmeta;
    public $kapacitetNovogPredmeta;
    public $editedPredmet;
    public $greska;

    public $rules = [
        'editedPredmet.naziv' => 'required',
        'editedPredmet.kapacitet' => 'required',
    ];

    public function render()
    {
        $this->predmets = Predmet::get();
        return view('livewire.predmets-table');
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

    public function otvoriUpdateModal($idPredmeta)
    {
        $this->editedPredmet = Predmet::where('id', $idPredmeta)->get()->first();
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
            Predmet::create(['naziv' => $this->nazivNovogPredmeta, 'kapacitet' => $this->kapacitetNovogPredmeta]);
            $this->dodaj = false;
        }
    }

    public function azuriraj()
    {
        if($this->verifyUpdate())
        {
            $this->editedPredmet->save();
            $this->azuriraj = false;
        }
    }

    public function delete($id)
    {
        Predmet::where('id', $id)->delete();
    }

    public function verifyUpdate()
    {
        $this->greska = "";
        if(!$this->editedPredmet->naziv)
        {
            $this->greska = $this->greska . "Naziv ne smije biti prazan!\n";
        }

        if(Predmet::where('naziv', $this->editedPredmet->naziv)->where('id', '!=', $this->editedPredmet->id)->exists())
        {
            $this->greska = $this->greska . "Predmet s ovim nazivom već postoji!\n";
        }

        if(!$this->editedPredmet->kapacitet)
        {
            $this->greska = $this->greska . "Definirajte kapacitet predmeta!\n";
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
        if(!$this->nazivNovogPredmeta)
        {
            $this->greska = $this->greska . "Naziv ne smije biti prazan!\n";
        }

        if(Predmet::where('naziv', $this->nazivNovogPredmeta)->exists())
        {
            $this->greska = $this->greska . "Predmet s ovim nazivom već postoji!\n";
        }

        if(!$this->kapacitetNovogPredmeta)
        {
            $this->greska = $this->greska . "Definirajte kapacitet predmeta!\n";
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
