<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FacilityController extends Controller
{
    public function index()
    {
        try {
            $facilities = Facility::all();
            return response()->json(['facilities' => $facilities]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching facilities.', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $facility = Facility::create($validate);

            return response()->json(['facility' => $facility]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Facility creation failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $facility = Facility::findOrFail($id);
            return response()->json(['facility' => $facility]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Facility not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching facility.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $facility = Facility::findOrFail($id);
            $facility->update($validate);

            return response()->json(['facility' => $facility]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Facility not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Facility update failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $facility = Facility::findOrFail($id);
            $facility->delete();

            return response()->json(['message' => 'Facility deleted.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Facility not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Facility deletion failed.', 'error' => $e->getMessage()], 500);
        }
    }
}
