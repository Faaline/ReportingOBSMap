<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Segment extends Model
{
    use HasFactory;
    protected $fillable=[
        'libelle'
    ];
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
    public function offreFibres()
    {
        return $this->belongsToMany(Offre::class,'segment_offre');
    }
    public function offreadsl()
    {
        return $this->belongsToMany(OffreAdsl::class,'segment_offre_adsl');
    }
    public function segmentMarche() : BelongsTo
    {
        return $this->belongsTo(SegmentMarche::class);
    }
}
