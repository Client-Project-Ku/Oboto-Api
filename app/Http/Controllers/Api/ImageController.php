<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'place_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imagePath = $request->file('image')->store('images', 'public');

            $image = Image::create([
                'name' => $request->input('name'),
                'place_id' => $request->input('place_id'),
                'path' => $imagePath,
            ]);

            return response()->json([
                'message' => 'Image created successfully',
                'image' => $image,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Image creation failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'place_id' => 'required',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $image = Image::findOrFail($id);

            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $imageName = $request->input('name') . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = $imageFile->storeAs('images', $imageName, 'public');
            } else {
                $imagePath = $image->path;
            }

            $image->update([
                'name' => $request->input('name'),
                'place_id' => $request->input('place_id'),
                'path' => $imagePath,
            ]);

            return response()->json([
                'message' => 'Image updated successfully',
                'image' => $image,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Image not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Image update failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $image = Image::findOrFail($id);
            Storage::disk('public')->delete($image->path);
            $image->delete();

            return response()->json(['message' => 'Image deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Image not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Image deletion failed.', 'error' => $e->getMessage()], 500);
        }
    }
}
