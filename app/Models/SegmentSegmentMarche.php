<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SegmentSegmentMarche extends Model
{
    use HasFactory;
    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }
    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }
    protected $guarded=[];
}
