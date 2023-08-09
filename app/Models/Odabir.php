<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Odabir extends Model
{
    use HasFactory;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function modul() : BelongsTo
    {
        return $this->belongsTo(Modul::class);
    }

    public function predmet() : BelongsTo
    {
        return $this->belongsTo(Predmet::class);
    }

    protected $fillable = [
        'predmet_id',
        'modul_id',
        'user_id',
        'prioritet'
    ];

}
