<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flags', function (Blueprint $table) {
            $table->id();
            $table->boolean('odabirModulaZakljucan')->default(false);
            $table->boolean('odabirPredmetaZakljucan')->default(false);
            $table->boolean('rezultatiDostupni')->default(false);
            $table->timestamps();
        });
        DB::table('flags')->insert(
            array(
                'odabirModulaZakljucan' => false,
                'odabirPredmetaZakljucan' => false,
                'rezultatiDostupni' => false
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flags');
    }
};
