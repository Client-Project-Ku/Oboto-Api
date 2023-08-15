<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json(['categories' => $categories]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching categories.', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category = Category::create($validate);

            return response()->json(['category' => $category]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Category creation failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json(['category' => $category]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching category.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category = Category::findOrFail($id);
            $category->update($validate);

            return response()->json(['category' => $category]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Category update failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json(['message' => 'Category deleted.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Category deletion failed.', 'error' => $e->getMessage()], 500);
        }
    }
}
