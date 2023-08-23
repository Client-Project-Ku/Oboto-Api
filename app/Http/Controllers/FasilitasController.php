<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Facility;
use App\Models\PlaceFacility;
use Illuminate\Http\Request;

class FasilitasController extends Controller
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
        $facility = Facility::all();
        return view('facility', [
            'place' => $place,
            'facility' => $facility,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PlaceFacility::create(
            $request->all()
        );

        return redirect()->route('fasilitas.create')->with('success', 'Sukses menambahkan fasilitas ke tempat wisata');
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
