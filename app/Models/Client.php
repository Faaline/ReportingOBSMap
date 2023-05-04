<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable= [
        'prenom',
        'nom',
        'contact',
        'ncli',
        'ndos',
        'nd',
        'login_smm',
        'bouquet',
    ];
}
