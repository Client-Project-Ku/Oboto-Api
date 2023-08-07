<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Enums\CategoryName;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::with(['category', 'district', 'facilities', 'images', 'reviews'])
            ->whereHas('category', function ($query) {
                $query->where('name', CategoryName::WISATA);
            })
            ->get();

        $places = $places->map(function ($place) {
            unset($place->category_id);
            unset($place->district_id);
            return $place;
        });

        return response()->json(['places' => $places]);
    }

    public function getPlaceEvent()
    {
        $places = Place::with(['category', 'district', 'facilities', 'images', 'reviews'])
            ->whereHas('category', function ($query) {
                $query->where('name', CategoryName::EVENT);
            })
            ->get();

        return response()->json(['places' => $places]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'open' => 'required|date_format:H:i',
            'close' => 'required|date_format:H:i',
            'ticket' => 'required|numeric',
            'contact' => 'required|string|max:15',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'category_id' => 'required|numeric',
            'district_id' => 'required|numeric',
        ]);
        
        $place = Place::create($validate);

        return response()->json(['place' => $place]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $place = Place::with(['category', 'district', 'facilities', 'images', 'reviews'])
            ->where('id', $id)
            ->first();

        return response()->json(['place' => $place]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $place = Place::find($id);
        
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'open' => 'required|date_format:H:i',
            'close' => 'required|date_format:H:i',
            'ticket' => 'required|numeric',
            'contact' => 'required|string|max:15',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'category_id' => 'required|numeric',
            'district_id' => 'required|numeric',
        ]);

        $place->update($validate);

        return response()->json(['place' => $place]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $place = Place::find($id);

        $place->delete();

        return response()->json(['message' => 'Place deleted successfully']);
    }
}
