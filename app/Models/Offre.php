<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offre extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable=[
        'type'
    ];


    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
    public function segments()
    {
        return $this->belongsToMany(Segment::class,'segment_offre');
    }
    public function fibres()
    {
        return $this->belongsToMany(Fibre::class,'offre_fibre');
    }



}
