<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Predmet;
use App\Models\Modul;
use App\Models\Odabir;

class OdabirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::all();
        $moduls = Modul::all();
        $predmets_zimski = Predmet::where('semestar', 'zimski')->get();
        $predmets_ljetni = Predmet::where('semestar', 'ljetni')->get();

        foreach($users as $user)
        {
            for($i = 0; $i < $moduls->count(); $i++)
            {
                Odabir::create(['user_id' => $user->id, 'modul_id' => $moduls[$i]->id, 'prioritet' => $i + 1]);
            }
            
            for($i = 0; $i < $predmets_zimski->count(); $i++)
            {
                Odabir::create(['user_id' => $user->id, 'predmet_id' => $predmets_zimski[$i]->id, 'prioritet' => $i + 1]);
            }

            for($i = 0; $i < $predmets_ljetni->count(); $i++)
            {
                Odabir::create(['user_id' => $user->id, 'predmet_id' => $predmets_ljetni[$i]->id, 'prioritet' => $i + 1]);
            }
        }

    }
}
