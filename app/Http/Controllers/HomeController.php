<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Place::with('category')->get();
        $wisata = Place::with('category')->where('category_id', 1)->count();
        $event = Place::with('category')->where('category_id', 2)->count();
        $user = User::count();
        return view('home', [
            'data' => $data,
            'wisata' => $wisata,
            'event' => $event,
            'user' => $user
        ]);
    }

    public function indexPlaces()
    {
        return view('place');
    }
    public function indexImages()
    {
        return view('image');
    }
}
