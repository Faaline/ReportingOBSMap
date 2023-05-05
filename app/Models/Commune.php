<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;
    public function communerepart()
    {
        return $this->hasMany(CommuneRepart::class);
    }
    public function clientcommune()
    {
        return $this->hasMany(ClientCommune::class);
    }
    protected $fillable=[
        'libelle'
    ];
}
