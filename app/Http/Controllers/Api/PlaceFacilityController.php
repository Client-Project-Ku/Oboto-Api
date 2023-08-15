<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlaceFacility;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PlaceFacilityController extends Controller
{
    public function store(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json(['message' => 'Place facility creation failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'place_id' => 'required',
                'facility_id' => 'required',
            ]);

            $placeFacility = PlaceFacility::findOrFail($id);

            $placeFacility->update([
                'place_id' => $request->input('place_id'),
                'facility_id' => $request->input('facility_id'),
            ]);

            return response()->json([
                'message' => 'Place facility updated successfully',
                'placeFacility' => $placeFacility,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Place facility not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Place facility update failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $placeFacility = PlaceFacility::findOrFail($id);
            $placeFacility->delete();

            return response()->json(['message' => 'Place facility deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Place facility not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Place facility deletion failed.', 'error' => $e->getMessage()], 500);
        }
    }
}
