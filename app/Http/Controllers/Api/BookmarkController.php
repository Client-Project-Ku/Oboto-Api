<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookmarkController extends Controller
{
    public function index()
    {
        try {
            $bookmark = auth()->user()->bookmarks()->with('place')->get();
            return response()->json(['bookmark' => $bookmark]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching bookmarks.', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'place_id' => 'required|numeric',
            ]);

            $bookmark = auth()->user()->bookmarks()->create($validate);

            return response()->json(['bookmark' => $bookmark]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Bookmark creation failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $bookmark = auth()->user()->bookmarks()->with('place')->where('id', $id)->firstOrFail();
            return response()->json(['bookmark' => $bookmark]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Bookmark not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching bookmark.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $validate = $request->validate([
                'place_id' => 'required|numeric',
            ]);

            $bookmark = auth()->user()->bookmarks()->where('id', $id)->firstOrFail();
            $bookmark->update($validate);

            return response()->json(['bookmark' => $bookmark]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Bookmark not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Bookmark update failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $bookmark = auth()->user()->bookmarks()->where('id', $id)->firstOrFail();
            $bookmark->delete();

            return response()->json(['message' => 'Bookmark deleted.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Bookmark not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Bookmark deletion failed.', 'error' => $e->getMessage()], 500);
        }
    }
}
