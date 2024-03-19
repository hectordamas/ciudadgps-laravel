<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Commerce;
use App\Models\Banner;
use App\Models\Story;
use App\Models\Like;
use Response;
use DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ApiHomeController extends Controller
{
    public function home(Request $request){
        try {
            $banners = Banner::where('hide', 'No')
            ->inRandomOrder()
            ->take(20)
            ->get();

            $categories = Category::whereNull('hidden')
            ->orderBy('position')
            ->get()
            ->take(20);

            $lat = $request->lat;
            $lon = $request->lon;
             
            $distance = DB::raw('(111.045 * acos( cos( radians('.$lat.') ) 
            * cos( radians( c.lat ) ) 
            * cos( radians( c.lon ) 
            - radians('.$lon.') ) 
            + sin( radians('.$lat.') ) 
            * sin( radians(c.lat) ) ) ) * 100 AS distance');

            $nearest = Commerce::from('commerces as c')
            ->select('id','name', 'rating', 'logo' , $distance)
            ->whereNotNull('paid')
            ->orderBy('distance')
            ->get()
            ->take(3)
            ->each(function($c) {
                $c->load('imgs')->take(1);
            });

            $filtrar = [];
            foreach($nearest as $n){
                array_push($filtrar, $n->id);
            }

            $commerces = Commerce::from('commerces as c')
            ->with(['imgs'])
            ->select('id','name', 'rating', 'logo' , $distance, 'lat', 'lon')
            ->whereNotNull('destacar')
            ->whereNotNull('paid')
            ->whereNotIn('id', $filtrar)
            ->orderBy('distance')
            ->get()
            ->take(3);


            if($request->userId){
                /*$stories = Like::where('user_id', $request->userId)
                ->with(['commerce.stories', 'commerce' => function($query) {
                    $query->orderBy('lastStoryId', 'desc');
                }])
                ->whereHas('commerce.stories', function ($query) {
                    $query->where('created_at', '>=', now()->subDays(1));
                })
                ->get()
                ->pluck('commerce')
                ->flatten();

                $storiesTotal = $stories->count();*/

                $stories = Commerce::with(['stories'])
                ->has('stories')
                ->whereHas('stories', function ($query) {
                    $query->where('created_at', '>=', Carbon::now()->subDays(1));
                })
                ->orderBy('lastStoryId', 'desc')
                ->get()
                ->take(15);

                $storiesTotal = $stories->count();
            }else{
                $stories = Commerce::with(['stories'])
                ->has('stories')
                ->whereHas('stories', function ($query) {
                    $query->where('created_at', '>=', Carbon::now()->subDays(1));
                })
                ->orderBy('lastStoryId', 'desc')
                ->get()
                ->take(15);

                $storiesTotal = $stories->count();
            }

            return response()->json([
                'categories' => $categories,
                'commerces' => $commerces,
                'banners' => $banners,
                'nearest' => $nearest,
                'stories' => $stories,
                'storiesTotal' => $storiesTotal,
                'STRIPE_KEY' => env('STRIPE_KEY'),
            ]);

        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAppStoresVersion() {
        return response()->json([
            'version' => "1.3.87",
            'appStoreVersionNumber' => "1.3.87",
            'playStoreVersionNumber' => "1.3.87",
            'storeVersions' => ["1.3.89", "1.3.90"]
        ]);
    }

}
