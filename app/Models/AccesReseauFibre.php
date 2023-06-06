<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesReseauFibre extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function accesreseau(): BelongsTo
    {
        return $this->belongsTo(AccesReseau::class);
    }
    public function fibre(): BelongsTo
    {
        return $this->belongsTo(Fibre::class);
    }
}
