<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Place;
use App\Models\District;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $place = Place::all();
        return view('image', [
            'place' => $place,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $imagePath = $request->file('image')->store('images', 'public');

        Image::create([
            'name' => $request->input('name'),
            'place_id' => $request->input('place_id'),
            'path' => $imagePath,
        ]);

        return redirect()->route('image.create')->with('success', 'Sukses menambahkan gambar' . $request->input("name") . ' ke galeri ');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
