<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientAgence extends Model
{
    use HasFactory;
    protected $fillable=[
        'client_id',
        'agence_id'
    ];
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function agence(): BelongsTo
    {
        return $this->belongsTo(Agence::class);
    }
}

