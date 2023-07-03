<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fibre extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function offres()
    {
        return $this->belongsToMany(Offre::class,'offre_fibre');
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

}
