<?php

namespace App\Http\Livewire;
use App\Models\Flag;
use App\Models\Odabir;
use App\Models\User;
use App\Models\Modul;
use App\Models\Predmet;
use Error;
use Livewire\Component;

class ZakljucajIzracunajUpis extends Component
{
    public $flags;
    public function render()
    {
        $this->flags = Flag::get()->first();
        return view('livewire.zakljucaj-izracunaj-upis');
    }

    public function otkModul()
    {
        Flag::get()->first()->update(['odabirModulaZakljucan' => false]);
        $this->emit('flagsRefresh');
    }

    public function zakModul()
    {
        Flag::get()->first()->update(['odabirModulaZakljucan' => true]);
        $this->emit('flagsRefresh');
    }

    public function otkPredmet()
    {
        Flag::get()->first()->update(['odabirPredmetaZakljucan' => false]);
        $this->emit('flagsRefresh');
    }

    public function zakPredmet()
    {
        Flag::get()->first()->update(['odabirPredmetaZakljucan' => true]);
        $this->emit('flagsRefresh');
    }

    public function izracunaj()
    {
        Flag::get()->first()->update(['odabirPredmetaZakljucan' => true]);
        Flag::get()->first()->update(['odabirModulaZakljucan' => true]);
        $studenti = User::get();
        foreach ($studenti as $student)
        {
            error_log($student->id);
            $k = 0.0;
            switch($student->godstud)
            {
                case 2:
                    $k = 1.0;
                    break;
                case 3:
                    $k = 0.75;
                    break;
                case 4:
                    $k = 0.5;
                    break;
                case 5:
                    $k = 0.25;
                    break;
            }
            $student->bodovi = $k * ($student->ects_pgod / 60) * ($student->prosjek_pgod / 5) * 
                ($student->ects / 120) * ($student->prosjek / 5) * 100;
            $student->save();
        }
        $studenti = User::orderBy('bodovi', 'desc')->get();  // DODATI DA ZANEMARI ADMIN KORISNIKE

        foreach ($studenti as $student)
        {
            $odabiri = $student->odabirs()->where('predmet_id', NULL)
                ->orderBy('prioritet', 'asc')->get();  //znaci da je odabir modula a ne predmeta 
            foreach ($odabiri as $odabir)
            {
                $modul = $odabir->modul()->get()->first();
                if($modul->popunjeno < $modul->kapacitet)
                {
                    $odabir->primljen = true;
                    $odabir->save();
                    $modul->popunjeno++;
                    $modul->save();
                    break;
                }
            }
            $odabiri = $student->odabirs()->where('modul_id', NULL)
            ->orderBy('prioritet', 'asc')->get();  //znaci da je odabir predmeta a ne modula 
            $upisano = 0; // broj upisanih predmeta
            foreach ($odabiri as $odabir)
            {
                $predmet = $odabir->predmet()->get()->first();
                if($predmet->popunjeno < $predmet->kapacitet)
                {
                    $odabir->primljen = true;
                    $odabir->save();
                    $predmet->popunjeno++;
                    $predmet->save();
                    $upisano++;
                    if($upisano >= 5)break;
                }
            }
        }
        Flag::get()->first()->update(['rezultatiDostupni' => true]);
        $this->emit('flagsRefresh');
        $this->emit('rezultatiRefresh');
    }

    public function resetiraj()
    {
        //Odabir::query()->update(['primljen' => false]);
        Odabir::query()->delete();
        Modul::query()->update(['popunjeno' => 0]);
        Predmet::query()->update(['popunjeno' => 0]);
        Flag::query()->update(['odabirModulaZakljucan' => false, 'odabirPredmetaZakljucan' => false,
        'rezultatiDostupni' => false]);
        $this->emit('flagsRefresh');
        $this->emit('rezultatiRefresh');
    }
}
