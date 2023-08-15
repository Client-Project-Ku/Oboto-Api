<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlaceFacility;

class PlaceFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'place_id' => 'required',
            'facility_id' => 'required',
        ]);

        $placeFacility = PlaceFacility::create([
            'place_id' => $request->input('place_id'),
            'facility_id' => $request->input('facility_id'),
        ]);

        return response()->json([
            'message' => 'Place facility created successfully',
            'placeFacility' => $placeFacility,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'place_id' => 'required',
            'facility_id' => 'required',
        ]);

        $placeFacility = PlaceFacility::find($id);

        $placeFacility->update([
            'place_id' => $request->input('place_id'),
            'facility_id' => $request->input('facility_id'),
        ]);

        return response()->json([
            'message' => 'Place facility updated successfully',
            'placeFacility' => $placeFacility,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $placeFacility = PlaceFacility::find($id);

        $placeFacility->delete();

        return response()->json([
            'message' => 'Place facility deleted successfully',
        ], 200);
    }
}
