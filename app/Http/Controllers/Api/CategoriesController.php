<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;
use App\Models\Commerce;
use Response;


class CategoriesController extends Controller
{
    public function getCommerces(Request $request){
        try {
            $lat = $request->lat;
            $lon = $request->lon;
            $orderBy = $request->orderBy;
            $mode = 'asc';
            $orderBy == 'distance' ? $mode = 'asc' : $mode = 'desc';

            $distance = DB::raw('(111.045 * acos( cos( radians('.$lat.') ) 
            * cos( radians( c.lat ) ) 
            * cos( radians( c.lon ) 
            - radians('.$lon.') ) 
            + sin( radians('.$lat.') ) 
            * sin( radians(c.lat) ) ) ) * 100 AS distance');
            
             $commerces = Commerce::from('commerces as c')
             ->select('c.id','c.name', 'c.rating', 'c.logo' , $distance, 'category_id', 'c.lat', 'c.lon', 'c.paid', 'c.expiration_date')
             ->whereNotNull('c.paid')                
             ->where('c.expiration_date', '>=', date('Y-m-d'))
             ->where('category_id', $request->category_id)
             ->without(['created_at', 'updated_at', 'imgs'])
             ->orderBy($orderBy, $mode)
             ->paginate(15);

             $category = Category::find($request->category_id);
 
            return Response::json([
                'commerces' => $commerces,
                'category' =>  $category
            ]);
 
         } catch (\Exception $e) {
             return Response::json(['error' => $e->getMessage()], 500);
         }
    }

    public function index(){
        $categories = Category::whereNull('hidden')->orderBy('position')->get();
        
        return response()->json([
            'categories' => $categories
        ]);
    }
}
