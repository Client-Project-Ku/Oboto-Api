<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PlaceCategory;

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
        $validation = $request->validate([
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'failed',
                'data' => $validation->errors()
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
