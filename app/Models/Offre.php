<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offre extends Model
{
    use HasFactory;
    protected $fillable=[
        'type'
    ];
    public function clientoffre():HasMany
    {
        return $this->hasMany(ClientOffre::class);
    }
    public function segmentoffre():HasMany
    {
        return $this->hasMany(SegmentOffre::class);
    }
    public function offrefibre():HasMany
    {
        return $this->hasMany(OffreFibre::class);
    }

}
