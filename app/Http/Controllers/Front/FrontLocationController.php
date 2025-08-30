<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class FrontLocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::all();
        return view('front-end.location.index', compact('locations'));
    }

}
