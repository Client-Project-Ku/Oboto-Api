<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function show(string $id)
    {
        //
    }

    public function edit($id) {
        $place = Place::findOrFail($id);
        $category = Category::all();
        $district = District::all();
        $facility = Facility::all();
        return view('editPlace', [
            'place' => $place,
            'category' => $category,
            'district' => $district,
            'facility' => $facility,
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $item = Place::findOrFail($id);

        $item -> update($input);
        $data = Place::with('category', 'district')
            ->orderBy('created_at', 'desc') // Sort by the 'created_at' column in descending order
            ->get();
        $wisata = Place::with('category')->where('category_id', 1)->count();
        $event = Place::with('category')->where('category_id', 2)->count();
        $user = User::count();
        return view('home', [
            'data' => $data,
            'wisata' => $wisata,
            'event' => $event,
            'user' => $user
        ]);
    }
}
