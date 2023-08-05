<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index ()
    {
        $facilities = \App\Models\Facility::all();

        return response()->json(['facilities' => $facilities]);
    }
}
