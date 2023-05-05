<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientOffre extends Model
{
    use HasFactory;
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }
    protected $guarded=[];
}

