<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Predmet extends Model
{
    use HasFactory;

    public function odabirs() : HasMany
    {
        return $this->hasMany(Odabir::class);
    }

    protected $fillable = [
        'naziv',
        'kapacitet'
    ];
}
