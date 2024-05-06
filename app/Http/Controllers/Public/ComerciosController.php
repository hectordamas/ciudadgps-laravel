<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commerce;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Img;
use App\Models\Tag;
use App\Models\User;
use App\Models\Product;
use GeoIP;
use DB;
use Illuminate\Support\Str;

class ComerciosController extends Controller
{
    private function getCommerces($categoryId = null) {
        $distance = null;
    
        if (session()->has('latitude') && session()->has('longitude')) {
            $lat = session('latitude');
            $lon = session('longitude');
    
            $distance = DB::raw('(111.045 * acos( cos( radians('.$lat.') ) 
                * cos( radians( commerces.lat ) ) 
                * cos( radians( commerces.lon ) - radians('.$lon.') ) 
                + sin( radians('.$lat.') ) 
                * sin( radians(commerces.lat) ) ) ) * 100 AS distance');
        }
    
        $query = Commerce::join('categories', 'categories.id', '=', 'commerces.category_id')
            ->distinct('commerces.id')
            ->leftJoin('tags', 'tags.commerce_id', '=', 'commerces.id');
    
        if ($distance) {
            $select = $query->select('commerces.id', 'commerces.name', 'commerces.rating', 'commerces.logo', 'commerces.excerpt', 'commerces.info', 'commerces.expiration_date', 'commerces.category_id', 'commerces.slug', $distance);
        } else {
            $select = $query->select('commerces.id', 'commerces.name', 'commerces.rating', 'commerces.logo', 'commerces.excerpt', 'commerces.info', 'commerces.expiration_date', 'commerces.category_id', 'commerces.slug');
        }
    
        $commerces = $select->where(function ($query) {
            $query
                ->whereNotNull('commerces.paid')
                ->where('commerces.expiration_date', '>=', date('Y-m-d'));
        });
    
        if ($categoryId) {
            $commerces->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            });
        }
    
        return $commerces;
    }

    private function getCommercesBySlug($slug) {
        $distance = null;
    
        if (session()->has('latitude') && session()->has('longitude')) {
            $lat = session('latitude');
            $lon = session('longitude');
    
            $distance = DB::raw('(111.045 * acos( cos( radians('.$lat.') ) 
                * cos( radians( commerces.lat ) ) 
                * cos( radians( commerces.lon ) - radians('.$lon.') ) 
                + sin( radians('.$lat.') ) 
                * sin( radians(commerces.lat) ) ) ) * 100 AS distance');
        }
    
        $query = Commerce::join('categories', 'categories.id', '=', 'commerces.category_id')
            ->distinct('commerces.id')
            ->leftJoin('tags', 'tags.commerce_id', '=', 'commerces.id');
    
        if ($distance) {
            $select = $query->select('commerces.id', 'commerces.name', 'commerces.rating', 'commerces.logo', 'commerces.excerpt', 'commerces.info', 'commerces.expiration_date', 'commerces.category_id', 'commerces.slug', $distance);
        } else {
            $select = $query->select('commerces.id', 'commerces.name', 'commerces.rating', 'commerces.logo', 'commerces.excerpt', 'commerces.info', 'commerces.expiration_date', 'commerces.category_id', 'commerces.slug');
        }
    
        $commerces = $select->where(function ($query) {
            $query
                ->whereNotNull('commerces.paid')
                ->where('commerces.expiration_date', '>=', date('Y-m-d'));
        });
    
        if ($slug) {
            $commerces->whereHas('categories', function ($query) use ($slug) {
                $query->where('categories.slug', $slug);
            });
        }
    
        return $commerces;
    }

    private function formatPhoneNumber($country_code, $phone_number) {
      $phone_number = preg_replace('/[^0-9]/', '', $phone_number); // Remover cualquier caracter que no sea número
      $phone_number = ltrim($phone_number, '0'); // Remover el cero inicial si lo hay
    
      if (substr($phone_number, 0, strlen($country_code)) != $country_code) {
        $phone_number = $country_code . $phone_number; // Agregar el código del país si no está presente
      }
    
      return $phone_number;
    }

    private function applyOrdering($commerces, $order, $hasLocation){
        if ($order === 'distance' && $hasLocation) {
            return $commerces->orderBy($order);
        } else {
            $orderColumn = $order === 'distance' ? 'id' : $order;
            $orderDirection = $order === 'distance' ? 'asc' : 'desc';
            return $commerces->orderBy($orderColumn, $orderDirection);
        }
    }

    public function index(Request $request){
        try{
            $commerces = $this->getCommerces()
                ->where(function($query) use ($request) {
                    $query
                        ->where('commerces.name', 'LIKE', "%$request->search%")
                        ->orWhere('commerces.info', 'LIKE', "%$request->search%")
                        ->orWhere('categories.name', "LIKE", "%$request->search%")
                        ->orWhere('tags.name', "LIKE", "%$request->search%");
                });
            
            $orderColumn = $request->order ? $request->order : (session()->has('latitude') && session()->has('longitude') ? 'distance' : 'id');
            $commerces = $this->applyOrdering($commerces, $orderColumn, session()->has('latitude'));
            
            $banners = Banner::paginate(15);

            $commercesKeywords = $commerces->get()->take(20);
            $allTags = $commercesKeywords->flatMap->tags->pluck('name')->unique()->toArray();
            $commerceNames = $commercesKeywords->pluck('name')->toArray();
            $tagsString = implode(', ', $allTags);
            $namesString = implode(', ', $commerceNames);
            $mergedString = $tagsString . ', ' . $namesString . ', ' . $request->search . ' en Caracas, ' . $request->search . ' en Venezuela';
            
            $keywords = $mergedString;
            $meta_description =  $request->search . ' en CiudadGPS: más de ' . $commerces->count() . ' resultados de Búsqueda: ' . $keywords;
    
        }catch(\Exception $e){
            return view('errors.404');
        }

        return view('public.commerces.index', [
            'commerces' => $commerces->paginate(10),
            'banners' => $banners,
            'search' => $request->search,
            'order' => $orderColumn,
            'keywords' => $keywords,
            'meta_description' => $meta_description
        ]);
    }
    
    public function categoria($id, Request $request){
        try {
            $category = Category::find($id);
            $orderColumn = $request->order ? $request->order : (session()->has('latitude') && session()->has('longitude') ? 'distance' : 'id');
            return redirect('/comercios/slug-categorias/' . $category->slug . '?order='. $orderColumn );

        } catch(\Exception $e) {
            return view('errors.404');
        }
    }

    public function categoriaSlug($slug, Request $request){
        try {
            $category = Category::where('slug', $slug)->first();
            if($category){
                $commerces = $this->getCommercesBySlug($slug);
                $orderColumn = $request->order ? $request->order : (session()->has('latitude') && session()->has('longitude') ? 'distance' : 'id');
                $commerces = $this->applyOrdering($commerces, $orderColumn, session()->has('latitude'));
        
                $banners = Banner::paginate(15);
    
                $commercesKeywords = $category->commerces()->take(20)->get();
                $allTags = $commercesKeywords->flatMap->tags->pluck('name')->unique()->toArray();
                $commerceNames = $commercesKeywords->pluck('name')->toArray();
                
                $tagsString = implode(', ', $allTags);
                $namesString = implode(', ', $commerceNames);
                
                $mergedString = $tagsString . ', ' . $namesString . ', ' . $category->name . ', ' . $category->name . ' en Venezuela, ' . $category->name . ' en Caracas, ' . $category->name . ' cerca, ' . $category->name . ' en infoguia, ' . $category->name . ' a domicilio';
                
                $keywords = $mergedString;
                $meta_description = $category->name . ' en CiudadGPS, más de ' . $commerces->count() . ' resultados de Búsqueda: ' . $namesString;
        
                return view('public.commerces.index', [
                    'commerces' => $commerces->paginate(10),
                    'banners' => $banners,
                    'category' => $category,
                    'order' => $orderColumn,
                    'keywords' => $keywords,
                    'meta_description' => $meta_description
                ]);
            }else{
                return view('errors.404');

            }
        } catch(\Exception $e) {
            return view('errors.404');
        }
    }

    public function redirect($id){
        $commerce = Commerce::find($id);
        return view('public.commerces.redirect', [
            'commerce' => $commerce
        ]);
    }

    public function show($id, Request $request){
        $commerce = Commerce::find($id);
        if($commerce){
            return redirect('/slug-comercios/' . $commerce->slug);
        }else{
            return view('errors.404');
        }
    }

    public function showSlug($slug, Request $request){
        $commerce = Commerce::where('slug', $slug)->first();
        
        if(!$commerce){
            return view('errors.404');
        }
    
        $tags = $commerce->tags->pluck('name')->unique()->toArray();
        $categories = $commerce->categories->pluck('name')->unique()->toArray();
    
        $categoriesInVenezuela = array_map(function($category) {
            return $category . ' en Venezuela';
        }, $categories);
    
        $categoriesInCaracas = array_map(function($category) {
            return $category . ' en Caracas';
        }, $categories);
    
        $keywords = implode(', ', array_merge($categories, $categoriesInVenezuela, $categoriesInCaracas, [$commerce->name], $tags));
        
        $meta_description = $commerce->name .' en CiudadGPS: '. $commerce->info;
    
        return view('public.commerces.show', [
            'commerce' => $commerce,
            'keywords' => $keywords,
            'meta_description' => $meta_description
        ]);
    }

    public function registrar(){
        $categories = Category::all();

        return view('public.commerces.registrar', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
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

        $commerce->rif = $request->rif;
        $commerce->info = $request->info;
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
        
        $commerce->twitter = $request->twitter;
        $commerce->youtube = $request->youtube;
        $commerce->address = $request->address;

        $commerce->facebook = $request->facebook;
        $commerce->tiktok = $request->tiktok;
        $commerce->threads = $request->threads;
        $commerce->instagram = $request->instagram;
        $commerce->web = $request->web;    
        
        $commerce->url = $request->url;
        $commerce->urlName = $request->urlName;  
    
        $commerce->payment = $request->payment;
        $commerce->category_id = $request->category;

        $commerce->position = $request->position;
        $commerce->destacar = $request->destacar;
        $commerce->expiration_date = date("Y-m-d", strtotime(date('Y-m-d') . "+ 1 year"));

        $commerce->save();

        if($request->categories){
            $commerce->categories()->sync($request->categories);
        }

        $images = $request->file('images');
        if(isset($images)){
            for($i = 0; $i < count($images); $i++){
                if($request->hasFile('images')){
                    $file = $images[$i];
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
        }

        if(isset($request->tags)){
            for($i = 0; $i < count($request->tags); $i++){
                $tag = new Tag();
                $tag->name = $request->tags[$i];
                $tag->commerce_id = $commerce->id;
                $tag->save();
            }
        }

        if($commerce->user_email){
            $user = User::where('email', strtolower($commerce->user_email))->first();
            if($user){
                $user->commerces()->attach($commerce);
            }
        }


        return redirect('/registrar-comercio')->with('message', "Su Registro y pago serán verificados, nos pondremos en contacto con usted en los próximos minutos para concretar el registro de su Establecimiento en nuestra plataforma");
    }

    public function shareCatalogo($id){    
        $commerce = Commerce::find($id);
        return view('public.commerces.shareCatalogo', [
            'commerce' => $commerce
        ]);
    }

    public function catalogo($id){
        $commerce = Commerce::find($id);

        if($commerce){
            return redirect('catalogo-productos/' . $commerce->slug);
        }else{
            return view('errors.404');
        }
    }

    public function catalogoSlug($slug){
        $commerce = Commerce::where('slug', $slug)->first();

        $products = Product::where('commerce_id', $commerce->id)        
        ->whereNull('hidden')
        ->get();

        $tags = $commerce->tags->pluck('name')->unique()->toArray();
        $categories = $commerce->categories->pluck('name')->unique()->toArray();
        $keywords = implode(', ', $categories) . ', ' . $commerce->name . ', ' . implode(', ', $tags);
        $meta_description = 'Catálogo de Productos de ' . $commerce->name .' en CiudadGPS: '. $commerce->info;
        
        return view('public.commerces.catalogo', [
            'products' => $products,
            'commerce' => $commerce, 
            'keywords' => $keywords, 
            'meta_description' => $meta_description
        ]);
    }

    public function productShare($id){
        $product = Product::find($id);

        return view('public.commerces.productShare', [
            'product' => $product
        ]);
    }
}  
