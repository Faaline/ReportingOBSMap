<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Segment extends Model
{
    use HasFactory;
    protected $fillable=[
        'libelle'
    ];

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
    public function segmentoffre()
    {
        return $this->hasMany(SegmentOffre::class);
    }
}
