<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Modul;

class PredmetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rpp_id = Modul::where('naziv', 'RPP')->get()->first()->id;
        $mms_id = Modul::where('naziv', 'MMS')->get()->first()->id;
        $is_id = Modul::where('naziv', 'IS')->get()->first()->id;

        DB::table('predmets')->insert(['naziv' => 'Multimedijske tehnologije', 'kapacitet' => 20, 'semestar' => 'zimski', 'modul_id' => $mms_id]);
        DB::table('predmets')->insert(['naziv' => 'Računalna grafika', 'kapacitet' => 20, 'semestar' => 'zimski', 'modul_id' => $mms_id]);
        DB::table('predmets')->insert(['naziv' => 'Računalna animacija', 'kapacitet' => 20, 'semestar' => 'zimski', 'modul_id' => $mms_id]);
        DB::table('predmets')->insert(['naziv' => 'Administriranje i sigurnost baza podataka', 'kapacitet' => 20, 'semestar' => 'zimski', 'modul_id' => $is_id]);
        DB::table('predmets')->insert(['naziv' => 'Dizajn korisničkog sučelja i iskustva', 'kapacitet' => 20, 'semestar' => 'zimski', 'modul_id' => $is_id]);
        DB::table('predmets')->insert(['naziv' => 'Informacijski sustavi specifične namjene', 'kapacitet' => 20, 'semestar' => 'zimski', 'modul_id' => $is_id]);
        DB::table('predmets')->insert(['naziv' => 'Mrežni i mobilni operacijski sustavi', 'kapacitet' => 20, 'semestar' => 'zimski']);
        DB::table('predmets')->insert(['naziv' => 'Analiza društvenih mreža', 'kapacitet' => 20, 'semestar' => 'zimski']);
        DB::table('predmets')->insert(['naziv' => 'Programske paradigme i jezici', 'kapacitet' => 20, 'semestar' => 'zimski', 'modul_id' => $rpp_id]);
        DB::table('predmets')->insert(['naziv' => 'Programiranje za rješavanje složenih problema', 'kapacitet' => 20, 'semestar' => 'zimski', 'modul_id' => $rpp_id]);
        DB::table('predmets')->insert(['naziv' => 'Programiranje za web', 'kapacitet' => 20, 'semestar' => 'zimski', 'modul_id' => $rpp_id]);

        DB::table('predmets')->insert(['naziv' => 'Osnove razvoja računalnih igara', 'kapacitet' => 20, 'semestar' => 'ljetni', 'modul_id' => $mms_id]);
        DB::table('predmets')->insert(['naziv' => 'Dizajniranje multimedije', 'kapacitet' => 20, 'semestar' => 'ljetni', 'modul_id' => $mms_id]);
        DB::table('predmets')->insert(['naziv' => 'Uvod u analizu i vizualizaciju podataka ', 'kapacitet' => 20, 'semestar' => 'ljetni', 'modul_id' => $is_id]);
        DB::table('predmets')->insert(['naziv' => 'Baze podataka nove generacije', 'kapacitet' => 20, 'semestar' => 'ljetni', 'modul_id' => $is_id]);
        DB::table('predmets')->insert(['naziv' => 'Upravljanje računalnim sustavima', 'kapacitet' => 20, 'semestar' => 'ljetni']);
        DB::table('predmets')->insert(['naziv' => 'Uvod u teorijsko računarstvo', 'kapacitet' => 20, 'semestar' => 'ljetni']);
        DB::table('predmets')->insert(['naziv' => 'Zajednički izborni predmet s UNIRI', 'kapacitet' => 20, 'semestar' => 'ljetni']);
        DB::table('predmets')->insert(['naziv' => 'Razvoj desktop i mobilnih aplikacija', 'kapacitet' => 20, 'semestar' => 'ljetni', 'modul_id' => $rpp_id]);
        DB::table('predmets')->insert(['naziv' => 'Programiranje za podatkovnu znanost', 'kapacitet' => 20, 'semestar' => 'ljetni', 'modul_id' => $rpp_id]);
    }
}
