<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index ()
    {
        $facilities = Facility::all();

        return response()->json(['facilities' => $facilities]);
    }

    public function store (Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $facility = Facility::create($validate);

        return response()->json(['facility' => $facility]);
    }

    public function show ($id)
    {
        $facility = Facility::find($id);

        return response()->json(['facility' => $facility]);
    }

    public function update (Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $facility = Facility::find($id);
        $facility->update($validate);

        return response()->json(['facility' => $facility]);
    }

    public function destroy ($id)
    {
        $facility = Facility::find($id);
        $facility->delete();

        return response()->json(['facility' => $facility]);
    }
}
