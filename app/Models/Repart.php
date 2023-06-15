<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repart extends Model
{
    use HasFactory;
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
    public function communes()
    {
        return $this->belongsToMany(Commune::class);
    }
    protected $guarded=[];
}
