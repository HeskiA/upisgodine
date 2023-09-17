<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('moduls')->insert(['naziv' => 'RPP', 'kapacitet' => 20]);
        DB::table('moduls')->insert(['naziv' => 'IS', 'kapacitet' => 20]);
        DB::table('moduls')->insert(['naziv' => 'MMS', 'kapacitet' => 20]);
    }
}
