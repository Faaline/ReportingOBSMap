<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OffreFibre extends Model
{
    use HasFactory;
    protected $guarded;

    public function offre():BelongsTo {
        return $this->belongsTo(Offre::class);
    }
    public function fibre(): BelongsTo {
        return $this->belongsTo(Fibre::class);
    }
}
