<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SegmentMarche extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function segments() : HasMany
    {
        return $this->hasMany(Segment::class,);
    }
}
