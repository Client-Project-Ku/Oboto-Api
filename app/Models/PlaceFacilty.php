<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceFacilty extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'facility_id',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
