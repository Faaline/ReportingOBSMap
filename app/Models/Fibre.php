<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fibre extends Model
{
    use HasFactory;

    public function offrefibre():HasMany
    {
        return $this->hasMany(OffreFibre::class);
    }
    protected $guarded=[];
}
