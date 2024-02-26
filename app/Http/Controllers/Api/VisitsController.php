<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Like;
use App\Models\Commerce;

class VisitsController extends BaseController
{
    public function index(Request $request){
        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }
        
        $commerce = Commerce::find($request->commerce_id);
        $visits = Visit::where('commerce_id', $request->commerce_id)            
        ->whereYear('created_at', '=', date('Y'))
        ->get(); 
        $likes = Like::where('commerce_id', $request->commerce_id)->count();

        $primerSemestreData = collect([]);
        $primerSemestreMeses = ['01', '02', '03', '04', '05', '06'];

        $segundoSemestreData = collect([]);
        $segundoSemestreMeses = ['07', '08', '09', '10', '11', '12'];

        foreach($primerSemestreMeses as $m){
            $data = Visit::where('commerce_id', $request->commerce_id)
            ->whereMonth('created_at', '=', $m)
            ->whereYear('created_at', '=', date('Y'))
            ->count();

            $primerSemestreData->push($data);
        }

        foreach($segundoSemestreMeses as $m){
            $data = Visit::where('commerce_id', $request->commerce_id)
            ->whereMonth('created_at', '=', $m)
            ->whereYear('created_at', '=', date('Y'))
            ->count();

            $segundoSemestreData->push($data);
        }

        return response()->json([
            'primerSemestreData' => $primerSemestreData,
            'segundoSemestreData' => $segundoSemestreData,
            'visitasTotales' => $visits->count(),
            'likes' => $likes,
            'commerce' => $commerce
        ]);

    }
}
