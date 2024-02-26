<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    public function pagoOnline(){
        return view('public.pagoOnline');
    }

    public function stripe(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Stripe\Customer::create([
            "email" => $request->email,
            "source" => $request->stripeToken,
        ]);

        Stripe\Charge::create([
            "amount" => 45 * 100,
            "currency" => "usd",
            "description" => "Pago por CiudadGPS.",
            "customer" => $customer->id
        ]);
  
        return redirect('/registrar-comercio')->with('message', 'Pago realizado con éxito!');
    }
}
