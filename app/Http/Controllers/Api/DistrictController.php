<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
    public function index ()
    {
        $districts = District::all();

        return response()->json(['districts' => $districts]);
    }

    public function store (Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $district = District::create($validate);

        return response()->json(['district' => $district]);
    }

    public function show ($id)
    {
        $district = District::find($id);

        return response()->json(['district' => $district]);
    }

    public function update (Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $district = District::find($id);
        $district->update($validate);

        return response()->json(['district' => $district]);
    }

    public function destroy ($id)
    {
        $district = District::find($id);
        $district->delete();

        return response()->json(['district' => $district]);
    }
}
