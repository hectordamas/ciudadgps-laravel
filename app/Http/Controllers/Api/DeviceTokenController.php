<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceToken;

class DeviceTokenController extends Controller
{
    public function store(Request $request) {
        $deviceToken = new DeviceToken();
        $deviceToken->token = $request->deviceToken;
        $deviceToken->save();

        return response()->json([
            'success' => 'Token creado con exito!'
        ]);
    }
}
