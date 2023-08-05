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
}