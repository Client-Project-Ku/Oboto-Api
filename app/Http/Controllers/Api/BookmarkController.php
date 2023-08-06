<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // with place in this current user
        $bookmark = auth()->user()->bookmarks()->with('place')->get();

        return response()->json(['bookmark' => $bookmark]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'place_id' => 'required|numeric',
        ]);

        $bookmark = auth()->user()->bookmarks()->create($validate);

        return response()->json(['bookmark' => $bookmark]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // with place
        $bookmark = auth()->user()->bookmarks()->with('place')->where('id', $id)->first();

        return response()->json(['bookmark' => $bookmark]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'place_id' => 'required|numeric',
        ]);

        $bookmark = auth()->user()->bookmarks()->where('id', $id)->first();
        $bookmark->update($validate);

        return response()->json(['bookmark' => $bookmark]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookmark = auth()->user()->bookmarks()->where('id', $id)->first();
        $bookmark->delete();

        return response()->json(['bookmark' => $bookmark]);
    }
}
