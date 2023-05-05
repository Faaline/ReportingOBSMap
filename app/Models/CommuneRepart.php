<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommuneRepart extends Model
{
    use HasFactory;
    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }
    public function repart(): BelongsTo
    {
        return $this->belongsTo(Repart::class);
    }
    protected $guarded=[];
}
