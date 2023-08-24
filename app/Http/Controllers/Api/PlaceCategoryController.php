<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PlaceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PlaceCategoryController extends Controller
{
    // make api resource with error response handling

    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => PlaceCategory::all()
        ], 200);
    }

    public function store(Request $request)
    {
         // Define validation rules
        $validationRules = [
            'name' => 'required'
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $validationRules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $placeCategory = PlaceCategory::create($request->all());

        return response()->json([
            'message' => 'success',
            'data' => $placeCategory
        ], 201);
    }

    public function show($id)
    {
        try {
            $placeCategory = PlaceCategory::findOrFail($id);

            return response()->json([
                'message' => 'success',
                'data' => $placeCategory
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'data' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $placeCategory = PlaceCategory::findOrFail($id);

            $validation = $request->validate([
                'name' => 'required'
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'message' => 'failed',
                    'data' => $validation->errors()
                ], 400);
            }

            $placeCategory->update($request->all());

            return response()->json([
                'message' => 'success',
                'data' => $placeCategory
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'data' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $placeCategory = PlaceCategory::findOrFail($id);

            $placeCategory->delete();

            return response()->json([
                'message' => 'success',
                'data' => null
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'data' => $e->getMessage()
            ], 404);
        }
    }
}
