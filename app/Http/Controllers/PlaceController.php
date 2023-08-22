<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Place;
use App\Models\Category;
use App\Models\District;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function create() {
        $district = District::all();
        $category = Category::all();
        return view('place', [
            'district' => $district,
            'category' => $category,
        ]);
    }

    public function store(Request $request) {

            $imagePath = $request->file('image')->store('images', 'public');
            $place = Place::create($request->all());

            $place->images()->create([
                'name' => $request->input('name'),
                'path' => $imagePath,
            ]);

            $district = District::all(); // Retrieve districts
            $category = Category::all(); // Retrieve categories

            return view('place', [
                'success' => 'Sukses menambahkan ' . $request->input("name"),
                'district' => $district,
                'category' => $category,
            ]);
    }
}
