<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceFacility extends Model
{
    use HasFactory;

    protected $table = 'place_facilties';
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
