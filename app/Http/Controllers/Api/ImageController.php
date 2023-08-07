<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
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
            'name' => 'required',
            'place_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
        ]);
    
        $imagePath = $request->file('image')->store('images', 'public');
    
        $image = Image::create([
            'name' => $request->input('name'),
            'place_id' => $request->input('place_id'),
            'path' => $imagePath, // Save the image path in the database
        ]);
    
        return response()->json([
            'message' => 'Image created successfully',
            'image' => $image,
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
            'name' => 'required',
            'place_id' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file if provided
        ]);

        $image = Image::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = $request->input('name') . '.' . $imageFile->getClientOriginalExtension();
            $imagePath = $imageFile->storeAs('images', $imageName, 'public');
        } else {
            // If no new image is provided, keep the existing image path
            $imagePath = $image->name;
        }

        // Update the image name and place_id
        $image->update([
            'name' => $request->input('name'),
            'place_id' => $request->input('place_id'),
            'path' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Image updated successfully',
            'image' => $image,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Image::findOrFail($id);
        $image->delete();

        return response()->json([
            'message' => 'Image deleted successfully',
        ], 200);
    }
}
