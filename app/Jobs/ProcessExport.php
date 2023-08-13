<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Response;

use App\Models\User;
use App\Models\Predmet;
use App\Models\Modul;



class ProcessExport implements ShouldQueue
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
    public function handle()
    {
        $fileName = 'users.csv';
        $users = User::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('id', 'user_id', 'email', 'predmet_id', 'predmet_naziv', 'modul_id', 'modul_naziv');

        $callback = function() use($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                $odabirs = $user->odabirs()->get();
                error_log($odabirs);
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
                        
                        fputcsv($file, array($row['id'], $row['user_id'], $row['email'], $row['predmet_id'],
                        $row['predmet_naziv'], $row['modul_id'], $row['modul_naziv']));
                    }
                }
          }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
