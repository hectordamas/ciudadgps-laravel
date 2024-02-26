<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function saveLocation(Request $request){
        session(['latitude' => $request->latitude, 'longitude' => $request->longitude]);

        return response()->json([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
    }
}
