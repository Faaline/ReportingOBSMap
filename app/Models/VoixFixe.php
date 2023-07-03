<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoixFixe extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function accesReseaus(): HasMany
    {
        return $this->hasMany(AccesReseau::class,);
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
