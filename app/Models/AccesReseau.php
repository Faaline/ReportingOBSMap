<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesReseau extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function accesreseaufibre(){
        return $this->hasMany(AccesReseauFibre::class);
    }
    public function voixfixe(){
        return $this->belongsTo(VoixFixe::class);
    }
}
