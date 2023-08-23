<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Place;
use App\Models\Category;
use App\Models\District;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Models\PlaceFacility;

class PlaceController extends Controller
{
    public function create() {
        $district = District::all();
        $category = Category::all();
        $facility = Facility::all();
        return view('place', [
            'district' => $district,
            'category' => $category,
            'facility' => $facility,
        ]);
    }

    public function store(Request $request) {

            $imagePath = $request->file('image')->store('images', 'public');
            $place = Place::create($request->all());

            $place->images()->create([
                'name' => $request->input('name'),
                'path' => $imagePath,
            ]);

            if ($request->has('facility_id')) {
                $facilities = $request->input('facility_id');
                    PlaceFacility::create([
                        'place_id' => $place->id,
                        'facility_id' => $facilities,
                    ]);
            }

            $district = District::all(); // Retrieve districts
            $category = Category::all(); // Retrieve categories
            $facility = Facility::all(); // Retrieve facilities

            return view('place', [
                'success' => 'Sukses menambahkan ' . $request->input("name"),
                'district' => $district,
                'category' => $category,
                'facility' => $facility,
            ]);
    }
}
