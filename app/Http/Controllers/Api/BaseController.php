<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commerce;

class BaseController extends Controller
{
    protected function checkIfCommerceHasUser($commerceId, $userId) {
        $commerce = Commerce::find($commerceId);
        $user = $commerce->users()->where('users.id', $userId)->exists();
    
        return $user;
    }
}
