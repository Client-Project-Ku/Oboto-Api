<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'place_id' => 'required|numeric',
                'comment' => 'required|string|max:255',
            ]);

            $review = auth()->user()->reviews()->create($validate);

            return response()->json(['review' => $review], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Review creation failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $review = auth()->user()->reviews()->where('id', $id)->first();
            $review->delete();

            return response()->json(['message' => 'Review deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Review not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Review deletion failed.', 'error' => $e->getMessage()], 500);
        }
    }
}
