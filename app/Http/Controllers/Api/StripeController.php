<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Stripe;

class StripeController extends Controller
{
    public function paymentIntent(Request $request){
        try{
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
            $response = Stripe\Token::create([
                "card" => [
                    "number" => $request->number,
                    "exp_month" => date_create_from_format('m/y', $request->expiry)->format('m'),
                    "exp_year" => date_create_from_format('m/y', $request->expiry)->format('y'),
                    "cvc" => $request->cvc,
                    "name" => $request->name  
                ]
            ]);

            $customer = Stripe\Customer::create([
                "email" => $request->email,
                "source" => $response->id,
            ]);
        
            Stripe\Charge::create([
                "amount" => 35 * 100,
                "currency" => "usd",
                "description" => "Pago por CiudadGPS.",
                "customer" => $customer->id
            ]);
        
        } catch (\Exception $e) {
            return \Response::json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
            'message' => 'Exitoso!'
        ]);
    }
}
