<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DistrictController extends Controller
{
    public function index()
    {
        try {
            $districts = District::all();
            return response()->json(['districts' => $districts]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching districts.', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $district = District::create($validate);

            return response()->json(['district' => $district]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'District creation failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $district = District::findOrFail($id);
            return response()->json(['district' => $district]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'District not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching district.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $district = District::findOrFail($id);
            $district->update($validate);

            return response()->json(['district' => $district]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'District not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'District update failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $district = District::findOrFail($id);
            $district->delete();

            return response()->json(['message' => 'District deleted.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'District not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'District deletion failed.', 'error' => $e->getMessage()], 500);
        }
    }
}
