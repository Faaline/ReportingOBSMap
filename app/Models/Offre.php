<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;
    protected $fillable=[
        'type'
    ];
    public function clientoffre()
    {
        return $this->hasMany(ClientOffre::class);
    }
    public function segmentoffre()
    {
        return $this->hasMany(SegmentOffre::class);
    }
}
