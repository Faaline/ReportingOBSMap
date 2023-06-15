<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;
    public function reparts()
    {
        return $this->belongsToMany(Repart::class);
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class,'client_commune');
    }
    protected $fillable=[
        'libelle'
    ];
}
