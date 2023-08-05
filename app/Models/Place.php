<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'open',
        'close',
        'ticket',
        'contact',
        'lat',
        'lng',
        'category_id',
        'district_id',
    ];
}
