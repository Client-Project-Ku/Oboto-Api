<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Enums\CategoryName;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PlaceController extends Controller
{
    public function index()
    {
        try {
            $places = Place::with(['category', 'district', 'facilities', 'images', 'reviews'])->get();

            $places = $places->map(function ($place) {
                $place->category_id = $place->category->name;
                $place->district_id = $place->district->name;
                unset($place->category);
                unset($place->district);
                
                $place->reviews->transform(function ($review) {
                    $review->user_name = $review->user->name; 
                    unset($review->user_id);
                    unset($review->user); 
                    return $review;
                });
                
                return $place;
            });

        

            return response()->json(['places' => $places]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching places.', 'error' => $e->getMessage()], 500);
        }
    }

    public function getPlaceEvent()
    {
        try {
            $places = Place::with(['category', 'district', 'facilities', 'images', 'reviews'])
                ->whereHas('category', function ($query) {
                    $query->where('name', CategoryName::EVENT);
                })
                ->get();

            $places = $places->map(function ($place) {
                $place->category_id = $place->category->name;
                $place->district_id = $place->district->name;
                unset($place->category_id);
                unset($place->district_id);
                return $place;
            });

            return response()->json(['places' => $places]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching event places.', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
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
                'event_date' => 'date_format:Y-m-d'
            ]);

            $place = Place::create($validate);

            return response()->json(['place' => $place], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Place creation failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $place = Place::with(['category', 'district', 'facilities', 'images', 'reviews'])
                ->where('id', $id)
                ->firstOrFail();

            $place->category_id = $place->category->name;
            $place->district_id = $place->district->name;
            unset($place->category);
            unset($place->district);

            return response()->json(['place' => $place]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Place not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching place.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $place = Place::findOrFail($id);

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
                'event_date' => 'date_format:Y-m-d'
            ]);

            $place->update($validate);

            return response()->json(['place' => $place]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Place not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Place update failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $place = Place::findOrFail($id);
            $place->delete();

            return response()->json(['message' => 'Place deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Place not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Place deletion failed.', 'error' => $e->getMessage()], 500);
        }
    }
}
