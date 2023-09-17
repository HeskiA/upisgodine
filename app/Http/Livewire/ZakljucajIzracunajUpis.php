<?php

namespace App\Http\Livewire;
use App\Models\Flag;
use App\Models\Odabir;
use App\Models\User;
use App\Models\Modul;
use App\Models\Predmet;
use App\Jobs\ProcessIzracun;
use Error;
use Livewire\Component;

class ZakljucajIzracunajUpis extends Component
{
    public $flags;
    public bool $uTijeku = false;
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
        $this->uTijeku = true;
        ProcessIzracun::dispatch();
    }

    public function resetiraj()
    {
        //Odabir::query()->update(['primljen' => false]);
        Odabir::query()->delete();
        Modul::query()->update(['popunjeno' => 0]);
        Predmet::query()->update(['popunjeno' => 0]);
        Flag::query()->update(['odabirModulaZakljucan' => false, 'odabirPredmetaZakljucan' => false,
        'rezultatiDostupni' => false]);
        $this->uTijeku = false;
        $this->emit('flagsRefresh');
        $this->emit('rezultatiRefresh');
    }

    public function preuzmi()
    {
        $fileName = 'rezultatiupisa.csv';
        $users = User::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('id', 'user_id', 'email', 'predmet_id', 'predmet_naziv', 'modul_id', 'modul_naziv', 'bodovi');

        $callback = function() use($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                $odabirs = $user->odabirs()->get();
                //error_log($odabirs);
                foreach ($odabirs as $odabir)
                {
                    if($odabir->primljen)
                    {
                        $row['id'] = $odabir->id;
                        $row['user_id'] = $odabir->user_id;
                        $row['email'] = $user->email;
                        $row['predmet_id'] = $odabir->predmet_id;

                        $predmet = Predmet::where('id', $odabir->predmet_id)->get()->first();
                        if($predmet){$row['predmet_naziv'] = $predmet->naziv;}
                        else{$row['predmet_naziv'] = '';}

                        $row['modul_id'] = $odabir->modul_id;

                        $modul = Modul::where('id', $odabir->modul_id)->get()->first();
                        if($modul){$row['modul_naziv'] = $modul->naziv;}
                        else{$row['modul_naziv'] = '';}

                        $row['bodovi'] = $user->bodovi;
                        
                        fputcsv($file, array($row['id'], $row['user_id'], $row['email'], $row['predmet_id'],
                        $row['predmet_naziv'], $row['modul_id'], $row['modul_naziv'], $row['bodovi']));
                    }
                }
          }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
