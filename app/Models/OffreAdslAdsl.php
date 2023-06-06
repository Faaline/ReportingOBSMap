<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAdslAdsl extends Model
{
    use HasFactory;

    protected $guarded;

    public function offreadsl():BelongsTo {
        return $this->belongsTo(OffreAdsl::class);
    }
    public function adsl(): BelongsTo {
        return $this->belongsTo(Adsl::class);
    }
}
