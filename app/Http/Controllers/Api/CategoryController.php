<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index ()
    {
        $categories = Category::all();

        return response()->json(['categories' => $categories]);
    }

    public function store (Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($validate);

        return response()->json(['category' => $category]);
    }

    public function show ($id)
    {
        $category = Category::find($id);

        return response()->json(['category' => $category]);
    }

    public function update (Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find($id);
        $category->update($validate);

        return response()->json(['category' => $category]);
    }

    public function destroy ($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json(['category' => $category]);
    }
}
