<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\District;
use App\Models\Bookmark;
use App\Models\Image;
use App\Models\Review;
use App\Models\Facility;
use App\Models\PlaceCategory;

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
        'event_date',
        'place_category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'place_facilties');
    }

    public function placeCategory()
    {
        return $this->belongsTo(PlaceCategory::class);
    }
}
