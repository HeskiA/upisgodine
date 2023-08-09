<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LazyCollection::make(function () {
            $handle = fopen(base_path("database/users.csv"), 'r');

            while (($line = fgetcsv($handle, 4096)) !== false) {
              yield $line;
            }
      
            fclose($handle);
          })
          ->skip(1)
          ->chunk(1000)
          ->each(function (LazyCollection $chunk) {
            $records = $chunk->map(function ($row) {
              return [
                  "name" => $row[0],
                  "email" => $row[1],
                  "password" => Hash::make($row[2]),
                  "prosjek" => $row[3],
                  "ects" => $row[4],
                  "godstud" => $row[5],
                  "ects_pgod" => $row[6],
                  "prosjek_pgod" => $row[7]
              ];
            })->toArray();
            
            DB::table('users')->insert($records);
          });
    }
}
