<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function statut(): BelongsTo
    {
        return $this->belongsTo(Statut::class,'client-id');
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }
    public function clientagence()
    {
        return $this->hasMany(ClientAgence::class);
    }
    public function clientoffre()
    {
        return $this->hasMany(ClientOffre::class);
    }
    public function clientrepart()
    {
        return $this->hasMany(ClientRepart::class);
    }
    public function clientcommune()
    {
        return $this->hasMany(ClientCommune::class);
    }
}
