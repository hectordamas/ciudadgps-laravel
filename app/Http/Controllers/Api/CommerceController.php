<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Commerce;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Category;
use Response;
use App\Models\Img;
use App\Models\Tag;
use Illuminate\Support\Str;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use App\Models\Story;
use App\Models\User;
use App\Models\Visit;
use App\Models\Weekday;
use App\Models\Question;
use App\Models\Job;

class CommerceController extends BaseController
{
    private function formatPhoneNumber($country_code, $phone_number) {
      $phone_number = preg_replace('/[^0-9]/', '', $phone_number); // Remover cualquier caracter que no sea número
      $phone_number = ltrim($phone_number, '0'); // Remover el cero inicial si lo hay
    
      if (substr($phone_number, 0, strlen($country_code)) != $country_code) {
        $phone_number = $country_code . $phone_number; // Agregar el código del país si no está presente
      }
    
      return $phone_number;
    }

    public function store(Request $request){   
        try {
            $slug = Str::slug($request->name);
            $count = DB::table('commerces')->where('slug', $slug)->count();
            $suffix = '';
    
            if ($count > 0) {
                $suffix = '-' . $count;
            }

            $commerce = new Commerce();
            $commerce->slug = $slug . $suffix;
            $commerce->name = $request->name;
            $commerce->user_name = $request->user_name;
            $commerce->user_lastname = $request->user_lastname;  

            $commerce->telephone_code = $request->telephone_code;
            $commerce->telephone_number_code = $request->telephone_number_code;
            if($request->telephone_number){
                $commerce->telephone_number = ltrim($request->telephone_number, '0');
                $commerce->telephone = $this->formatPhoneNumber($request->telephone_number_code, $request->telephone_number);  
            }else{
                $commerce->telephone_number = NULL;
                $commerce->telephone = NULL;
            }
            $commerce->whatsapp_code = $request->whatsapp_code;
            $commerce->whatsapp_number_code = $request->whatsapp_number_code;

            if($request->whatsapp_number){
                $commerce->whatsapp_number = ltrim($request->whatsapp_number, '0');
                $commerce->whatsapp = $this->formatPhoneNumber(str_replace('+', '', $request->whatsapp_number_code), $request->whatsapp_number);
            }else{
                $commerce->whatsapp_number = NULL;
                $commerce->whatsapp = NULL;
            }
            $commerce->info = $request->info;
            $commerce->rif = $request->rif;
            $commerce->address = $request->address;
            $commerce->lat = $request->lat;   
            $commerce->lon = $request->lon;
            
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $path = public_path(). '/logos/' ;
                $fileName = time() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $fileUri = '/logos/'. $fileName;
                $commerce->logo = $fileUri;
            }

            $commerce->user_email = strtolower($request->user_email);  
            $commerce->facebook = $request->facebook;
            $commerce->tiktok = $request->tiktok;
            $commerce->threads = $request->threads;
            $commerce->instagram = $request->instagram;
            $commerce->web = $request->web;    
            $commerce->twitter = $request->twitter;
            $commerce->youtube = $request->youtube;
            $commerce->address = $request->address;

            $commerce->payment = $request->payment;
            if($request->category){
                $commerce->category_id = $request->category;
            }
            $commerce->expiration_date = date("Y-m-d", strtotime(date('Y-m-d') . "+ 1 year"));

            $commerce->url = $request->url;
            $commerce->urlName = $request->urlName;

            $commerce->save();

            if(isset($request->selectedCategories)){
                if(count($request->selectedCategories) > 0){
                    $commerce->categories()->sync($request->selectedCategories);
                }
            }

            for($i = 0; $i < $request->photosCount; $i++){
                if($request->hasFile('photos' . $i)){
                    $file = $request->file('photos' . $i);
                    $path = public_path(). '/photos/' ;
                    $fileName = time() . $file->getClientOriginalName();
                    $file->move($path, $fileName);
                    $fileUri = '/photos/'. $fileName;

                    $image = new Img();
                    $image->uri = $fileUri;
                    $image->commerce_id = $commerce->id;
                    $image->save();
                }
            }

            for($i = 0; $i < $request->tagsCount; $i++){
                $tag = new Tag();
                $tag->name = $request->input('tags' . $i);
                $tag->commerce_id = $commerce->id;
                $tag->save();
            }

            if($commerce->user_email){
                $users = User::where('email', strtolower($commerce->user_email))->get();

                foreach($users as $user){
                    $user->commerces()->syncWithoutDetaching([$commerce->id]);
                }
            }

            return Response::json([
                'success' => "Comercio Registrado con éxito!",
                'commerce' => $commerce,
            ]);

        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }

    }

    public function searchCommerces(Request $request){
        try {
            $commerces = Commerce::select('id','name', 'lat', 'lon')
            ->where(function($query){
                $query
                ->whereNotNull('paid')                
                ->where('expiration_date', '>=', date('Y-m-d'));
            })
            ->where(function($query) use ($request) {
                $query
                ->where('name', "LIKE", "%$request->textInput%")
                ->orWhere('info', "LIKE", "%$request->textInput%");
            })
            ->orderByRaw("CASE 
                WHEN name LIKE '{$request->textInput}%' THEN 0
                WHEN name LIKE '%{$request->textInput}' THEN 2
                ELSE 1 
                END, 
                SUBSTRING(name, LOCATE('{$request->textInput}', name)) COLLATE utf8mb4_general_ci")
            ->without(['created_at', 'updated_at', 'imgs'])
            ->take(3)
            ->get();

            $categories = Category::select('id','name')
            ->where('name', "LIKE", "%$request->textInput%")
            ->orderByRaw("CASE 
                WHEN name LIKE '{$request->textInput}%' THEN 0
                WHEN name LIKE '%{$request->textInput}' THEN 2
                ELSE 1 
                END, 
                SUBSTRING(name, LOCATE('{$request->textInput}', name)) COLLATE utf8mb4_general_ci")
            ->take(3)
            ->get();


            return Response::json([
                'commerces' => $commerces,
                'categories' => $categories,
            ]);

        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }

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
             ->with(['likes'])
             ->distinct('c.id')
             ->select('c.id','c.name', 'c.rating', 'c.logo' , $distance, 'c.lat', 'c.lon')
             ->join('categories as ca', 'ca.id', '=', 'c.category_id')
             ->leftJoin('tags as t', 't.commerce_id', '=', 'c.id')
             ->leftJoin('products as p', 'p.commerce_id', '=', 'c.id')
             ->where(function($query){
                $query
                ->whereNotNull('c.paid')                
                ->where('c.expiration_date', '>=', date('Y-m-d'));             
            })
            ->where(function($query) use ($request) {
                $query
                ->where('c.name', "LIKE", "%$request->text%")
                ->orWhere('t.name', "LIKE", "%$request->text%")
                ->orWhere('p.name', "LIKE", "%$request->text%")
                ->orWhere('c.info', "LIKE", "%$request->text%")
                ->orWhere('ca.name', "LIKE", "%$request->text%");
            })
            ->orderBy($orderBy, $mode)
            ->paginate(15);

            return Response::json(['commerces' => $commerces ]);
 
         } catch (\Exception $e) {
             return Response::json(['error' => $e->getMessage()], 500);
         }
    }

    public function getCommercesDestacados(Request $request){
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
             ->select('c.id','c.name', 'c.rating', 'c.logo' , 'c.destacar', $distance, 'c.lat', 'c.lon')
             ->where('c.expiration_date', '>=', date('Y-m-d'))
             ->whereNotNull('c.paid')                
             ->whereNotNull('c.destacar')
             ->orderBy($orderBy, $mode)
             ->paginate(15);

            return Response::json(['commerces' => $commerces ]);
 
         } catch (\Exception $e) {
             return Response::json(['error' => $e->getMessage()], 500);
         }
    }

    public function show($id, Request $request){
        try{
            $lat = $request->lat;
            $lon = $request->lon;
            
            $distance = DB::raw('(111.045 * acos( cos( radians('.$lat.') ) 
            * cos( radians( c.lat ) ) 
            * cos( radians( c.lon ) 
            - radians('.$lon.') ) 
            + sin( radians('.$lat.') ) 
            * sin( radians(c.lat) ) ) ) * 100 AS distance');
    
            $commerce = Commerce::from('commerces as c')
            ->with(['likes', 'imgs', 'category', 'categories', 'tags', 'users:id'])
            ->select('id','name', 'rating', 'logo' , 'info', 'lat', 'lon', 'category_id', 'web','telephone', 'facebook', 
            'whatsapp', 'instagram', 'user_email', $distance, 'youtube', 'address', 'twitter', 'enable', 'tiktok', 'threads', 
            'hourEnable', 'url', 'urlName')
            ->whereNotNull('paid')                
            ->where('expiration_date', '>=', date('Y-m-d'))
            ->where('id', $id)
            ->first();

            $questions = Question::with(['user'])
            ->where('commerce_id', $commerce->id)
            ->orderBy('id', 'desc')
            ->get()
            ->take(3)
            ->each(function($q) {
                $q->load('answers.user')->take(1);
            });

            $comments = Comment::where('commerce_id', $commerce->id)
            ->with(['user'])
            ->orderBy('id', 'desc')
            ->get()
            ->take(3);

            $visit = new Visit();
            $visit->ip = $request->ip();
            $visit->commerce_id = $commerce->id;
            $visit->save();

            $products = Product::whereNull('hidden')
            ->where('commerce_id', $commerce->id)
            ->get()
            ->take(6);

            $jobs = Job::where('commerce_id', $commerce->id)
            ->count();

            $weekdays = Weekday::all();
            $firstDay = $weekdays->shift();
            $weekdays->push($firstDay);
    
            $hours = $commerce->weekdays;
    
            $days = $weekdays->map(function($day) use ($hours) {
                $weekday = $hours->where('name', $day->name)->first();
    
                if ($weekday) {
                    return [
                        'id' => $day->id,
                        'name' => $day->name,
                        'hour_open' => $weekday->pivot->hour_open,
                        'minute_open' => $weekday->pivot->minute_open,
                        'hour_close' => $weekday->pivot->hour_close,
                        'minute_close' => $weekday->pivot->minute_close,
                        'isSelected' => true
                    ];
                }else {
                    return [
                        'id' => $day->id,
                        'name' => $day->name,
                        'hour_open' => null,
                        'minute_open' => null,
                        'hour_close' => null,
                        'minute_close' => null,
                        'isSelected' => false
                    ];
                }
            });
    
        }catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
        return response()->json([
            'commerce' => $commerce,
            'comments' => $comments,
            'products' => $products,
            'jobsCount' => $jobs,
            'days' => $days,
            'questions' => $questions
        ]);
    }

    public function edit($id, Request $request){
        try{
            if (!$this->checkIfCommerceHasUser($id, $request->user()->id)) {
                return response()->json([
                    'error' => 'Tu usuario no está asociado a este comercio.'
                ]);
            }
    
            $commerce = Commerce::with(['imgs', 'tags', 'category', 'categories'])->find($id);
    
            return response()->json([
                'commerce' => $commerce
            ]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update($id, Request $request){
        try{
            if (!$this->checkIfCommerceHasUser($id, $request->user()->id)) {
                return response()->json([
                    'error' => 'Tu usuario no está asociado a este comercio.'
                ]);
            }

            $slug = Str::slug($request->name);
            $count = DB::table('commerces')->where('slug', $slug)->where('id', '!=', $id)->count();
            $suffix = '';
    
            if ($count > 0) {
                $suffix = '-' . $count;
            }

            $commerce = Commerce::find($id);
            $commerce->slug = $slug . $suffix;
            $commerce->name = $request->name;
            $commerce->telephone_code = $request->telephone_code;
            $commerce->telephone_number_code = $request->telephone_number_code;
            if($request->telephone_number){
                $commerce->telephone_number = ltrim($request->telephone_number, '0');
                $commerce->telephone = $this->formatPhoneNumber($request->telephone_number_code, $request->telephone_number);  
            }else{
                $commerce->telephone_number = NULL;
                $commerce->telephone = NULL;
            }
            $commerce->whatsapp_code = $request->whatsapp_code;
            $commerce->whatsapp_number_code = $request->whatsapp_number_code;
            if($request->whatsapp_number){
                $commerce->whatsapp_number = ltrim($request->whatsapp_number, '0');
                $commerce->whatsapp = $this->formatPhoneNumber(str_replace('+', '', $request->whatsapp_number_code), $request->whatsapp_number);
            }else{
                $commerce->whatsapp_number = NULL;
                $commerce->whatsapp = NULL;
            }
            
            $commerce->info = $request->info;
            $commerce->rif = $request->rif;
            $commerce->address = $request->address;
            $commerce->lat = $request->lat;   
            $commerce->lon = $request->lon;
            $commerce->user_email = strtolower($request->user_email);  

            $commerce->facebook = $request->facebook;
            $commerce->tiktok = $request->tiktok;
            $commerce->threads = $request->threads;
            $commerce->instagram = $request->instagram;
            $commerce->web = $request->web;    
            $commerce->twitter = $request->twitter;
            $commerce->youtube = $request->youtube;
            $commerce->category_id = $request->selectedCategories[0];
            $commerce->categories()->sync($request->selectedCategories);

            $commerce->url = $request->url;
            $commerce->urlName = $request->urlName;

            $commerce->save();

            if(isset($request->selectedCategories)){
                if(count($request->selectedCategories) > 0){
                    $commerce->categories()->sync($request->selectedCategories);
                }
            }

            $commerce->tags()->delete();

            for($i = 0; $i < $request->tagsCount; $i++){
                $tag = new Tag();
                $tag->name = $request->input('tags' . $i);
                $tag->commerce_id = $commerce->id;
                $tag->save();
            }

            if($commerce->user_email){
                $users = User::where('email', strtolower($commerce->user_email))->get();

                foreach($users as $user){
                    $user->commerces()->syncWithoutDetaching([$commerce->id]);
                }    
            }

            return Response::json([
                'success' => "Comercio actualizado con éxito!",
                'commerce' => $commerce,
            ]);

        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function newStory(Request $request){

        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }

        $commerce_id = $request->commerce_id;
        $story = new Story();
        $story->text = $request->comment;
        $story->commerce_id = $commerce_id;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = public_path(). '/storiesImages/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/storiesImages/'. $fileName;
            $story->image = $fileUri;
        }
        $story->save();

        $commerce = Commerce::find($commerce_id);
        $commerce->lastStoryId = $story->id;
        $commerce->save(); 

        return response()->json([
            'success' => 'Historia creada con éxito'
        ]);
    }

    public function destroyStory(Request $request){
        $story = Story::find($request->story_id);
        if (!$this->checkIfCommerceHasUser($story->commerce->id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }

        $story_id = $request->story_id;
        $story->delete();

        return response()->json([
            'success' => 'Historia eliminada con éxito'
        ]);
    }

}
