<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAdsl extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function offreadsladsl():HasMany
    {
        return $this->hasMany(OffreAdslAdsl::class);
    }


}
