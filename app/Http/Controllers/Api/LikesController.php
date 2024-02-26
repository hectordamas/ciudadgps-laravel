<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Commerce;
use App\Models\User;
use DB;

class LikesController extends BaseController
{
    public function like(Request $request){
        $like = new Like();
        $like->user_id = $request->user_id;
        $like->commerce_id = $request->commerce_id;
        $like->save();
        
        return response()->json([
            'like' => $like,
            'message' => 'Agregado a Favoritos!' 
        ]);
    }

    public function dislike(Request $request){
        $like = Like::where('user_id', $request->user_id)
        ->where('commerce_id', $request->commerce_id)
        ->first();

        $like->delete();

        return response()->json([
            'message' => 'Eliminado de Favoritos!' 
        ]);
    }

    public function likes(Request $request){
        try {
            $lat = $request->lat;
            $lon = $request->lon;

            $distance = DB::raw('(111.045 * acos( cos( radians('.$lat.') ) 
            * cos( radians(c.lat) ) 
            * cos( radians(c.lon) 
            - radians('.$lon.') ) 
            + sin( radians('.$lat.') ) 
            * sin( radians(c.lat) ) ) ) * 100 AS distance');

            $commerces = Commerce::from('commerces as c')    
            ->with(['likes'])        
            ->whereNotNull('paid')
            ->select('c.id','c.name', 'c.rating', 'c.logo' , $distance)
            ->join('likes as l', 'l.commerce_id', '=', 'c.id')
            ->where('l.user_id', $request->user_id)
            ->without(['created_at', 'updated_at', 'imgs'])
            ->orderBy('l.id', 'desc')
            ->get();

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json([
            'commerces' => $commerces->unique('id')
        ]);
    }
}
