<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoixFixe extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function accesreseaus(): HasMany
    {
        return $this->hasMany(AccesReseau::class,);
    }
}
