<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAdsl extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function adsls()
    {
        return $this->belongsToMany(Adsl::class,'offre_adsl_adsl');
    }
    public function segments()
    {
        return $this->belongsToMany(Segment::class,'segment_offre_adsl');
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }


}
