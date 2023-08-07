<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'place_id',
        'path'
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
