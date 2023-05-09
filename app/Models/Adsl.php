<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adsl extends Model
{
    use HasFactory;
    public function clientadsl()
    {
        return $this->hasMany(ClientAdsl::class);
    }
}
