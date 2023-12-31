<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Predmet;
use App\Models\Modul;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('odabirs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Predmet::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Modul::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class);
            $table->integer('prioritet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odabirs');
    }
};
