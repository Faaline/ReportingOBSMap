<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repart extends Model
{
    use HasFactory;
    public function clientrepart()
    {
        return $this->hasMany(ClientRepart::class);
    }
    public function communerepart()
    {
        return $this->hasMany(CommuneRepart::class);
    }
    protected $guarded=[];
}
