<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Flag;
use App\Models\User;

class ProcessIzracun implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Flag::get()->first()->update(['odabirPredmetaZakljucan' => true]);
        Flag::get()->first()->update(['odabirModulaZakljucan' => true]);
        $studenti = User::get();
        foreach ($studenti as $student)
        {
            //error_log($student->id);
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
        $studenti = User::where('userType', 'user')->orderBy('bodovi', 'desc')->get();

        foreach ($studenti as $student)
        {
            $upisaniModul = NULL;
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
                    $upisaniModul = $modul;
                    break;
                }
            }
            $odabiri = $student->odabirs()->where('modul_id', NULL)
            ->orderBy('prioritet', 'asc')->get();  //znaci da je odabir predmeta a ne modula 
            $upisanoZimskih = 0; // broj upisanih predmeta
            $upisanoLjetnih = 0; // broj upisanih predmeta
            foreach ($odabiri as $odabir)
            {
                $predmet = $odabir->predmet()->get()->first();
                if($predmet->popunjeno < $predmet->kapacitet && $predmet->modul() != $upisaniModul)
                {
                    if($predmet->semestar == 'zimski' && $upisanoZimskih < 3)
                    {
                        $odabir->primljen = true;
                        $odabir->save();
                        $predmet->popunjeno++;
                        $predmet->save();
                        $upisanoZimskih++;
                    }
                    elseif($upisanoLjetnih < 2)
                    {
                        $odabir->primljen = true;
                        $odabir->save();
                        $predmet->popunjeno++;
                        $predmet->save();
                        $upisanoLjetnih++;
                    }

                    if($upisanoZimskih == 3 && $upisanoLjetnih == 2)break;
                }
            }
        }
        Flag::get()->first()->update(['rezultatiDostupni' => true]);
    }
}
