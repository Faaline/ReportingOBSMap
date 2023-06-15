<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adsl extends Model
{
    use HasFactory;
    public function clients()
    {
        return $this->belongsToMany(Client::class,'client_adsl');
    }

    public function offreAdsls()
    {
        return $this->belongsToMany(OffreAdsl::class,'offre_adsl_adsl');
    }
    protected $guarded=[];


}
