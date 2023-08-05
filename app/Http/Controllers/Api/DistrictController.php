<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index ()
    {
        $districts = \App\Models\District::all();

        return response()->json(['districts' => $districts]);
    }
}
