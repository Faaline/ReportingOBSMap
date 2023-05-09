<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fibre extends Model
{
    use HasFactory;
    public function offre(){
        return $this->belongsTo(Offre::class);
    }
}
