<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function statut(): BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }
    public function agences()
    {
        return $this->belongsToMany(Agence::class,'client_agence');
    }
    public function offres()
    {
        return $this->belongsToMany(Offre::class);
    }
    public function reparts()
    {
        return $this->belongsToMany(Repart::class);
    }
    public function communes()
    {
        return $this->belongsToMany(Commune::class,'client_commune');
    }
    public function adsls()
    {
        return $this->belongsToMany(Adsl::class,'client_adsl');
    }
    public function fibres()
    {
        return $this->belongsToMany(Fibre::class);
    }
    public function offreAdsl()
    {
        return $this->belongsToMany(OffreAdsl::class);
    }
    public function voixFixes()
    {
        return $this->belongsToMany(VoixFixe::class);
    }
}
