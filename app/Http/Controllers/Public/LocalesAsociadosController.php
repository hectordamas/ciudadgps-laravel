<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commerce;
use App\Models\Category;
use App\Models\Pcategory;
use App\Models\User;
use App\Models\Product;
use App\Models\Weekday;
use App\Models\Visit;
use App\Models\Like;
use App\Models\Job;
use Illuminate\Support\Str;
use DB;

class LocalesAsociadosController extends Controller
{
    private function formatPhoneNumber($country_code, $phone_number) {
        $phone_number = preg_replace('/[^0-9]/', '', $phone_number); // Remover cualquier caracter que no sea número
        $phone_number = ltrim($phone_number, '0'); // Remover el cero inicial si lo hay
      
        if (substr($phone_number, 0, strlen($country_code)) != $country_code) {
          $phone_number = $country_code . $phone_number; // Agregar el código del país si no está presente
        }
      
        return $phone_number;
    }
    
    public function index(Request $request){
        $user = User::find($request->user()->id);
        $commerces = $user->commerces;

        return view('public.localesAsociados.index', [
            'commerces' => $commerces
        ]);

    }

    public function edit($id){
        $commerce = Commerce::find($id);
        $categories = Category::all();

        return view('public.localesAsociados.edit', [
            'commerce' => $commerce,
            'categories' => $categories,
        ]);
    }

    public function uploadLogo(Request $request)
    {
        $commerce = Commerce::find($request->commerce_id);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = public_path(). '/logos/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/logos/'. $fileName;
            $commerce->logo = $fileUri;
            $commerce->save();

            return response()->json(['success' => true, 'logo_url' => asset($commerce->logo)]);
        }

        return response()->json(['success' => false, 'message' => 'Logo upload failed']);
    }

    public function categoriesStore(Request $request){
        $pcategory = new Pcategory();
        $pcategory->commerce_id = $request->commerce_id;
        $pcategory->name = $request->name;
        $pcategory->save();

        return redirect()->back()->with('message', 'Categoria creada con éxito!');
    }

    public function categoriesEdit($id){
        $pcategory = Pcategory::find($id);

        return view('public.localesAsociados.products.pcategories.edit', [
            'pcategory' => $pcategory
        ]);
    }

    public function categoriesUpdate($id, Request $request){
        $pcategory = Pcategory::find($id);
        $pcategory->name = $request->name;
        $pcategory->save();

        return redirect('/locales-asociados/productos/' . $pcategory->commerce->id)
        ->with('message', 'Categoría modificada con éxito!');
    }

    public function categoriesDestroy($id){
        $pcategory = Pcategory::find($id);

        $products = $pcategory->products;

        foreach($products as $p){
            $p->pcategory_id = NULL;
            $p->save();
        }

        $pcategory->delete();

        return redirect()
                ->back()
                ->with('message', 'Categoria eliminada con éxito!');
    }

    public function setIsEnable(Request $request){
        $commerce = Commerce::find($request->commerce_id);
        $commerce->enable = $request->enable == 'active' ? 'active' : NULL;
        $commerce->save();

        return response()->json([
            'message' => 'Catalogo activado de forma existosa!'
        ]);   
    }

    public function productos($id){
        $commerce = Commerce::find($id);
        $products = $commerce->products()->orderBy('id', 'desc')->get();
        $pcategories = $commerce->pcategories()->orderBy('id', 'desc')->get();

        return view('public.localesAsociados.products.index', [
            'products' => $products,
            'commerce' => $commerce,
            'pcategories' => $pcategories
        ]);
    }

    public function productsStore(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;   
        $product->description = $request->description;           
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = public_path(). '/products/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/products/'. $fileName;
            $product->image = $fileUri;
        }
        $product->commerce_id = $request->commerce_id;
        $product->pcategory_id = $request->pcategory_id;
        $slug = Str::slug($request->name);
        $count = DB::table('products')->where('slug', $slug)->count();
        $suffix = '';

        if ($count > 0) {
            $suffix = '-' . $count;
        }
        $product->slug = $slug . $suffix;
        $product->save();

        return redirect()->back()->with('message', 'Producto creado con éxito!');
    }

    public function productsEdit($id){
        $product = Product::find($id);
        return view('public.localesAsociados.products.edit', [
            'product' => $product
        ]);
    }

    public function productsUpdate($id, Request $request){
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;    
        $product->description = $request->description;           
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = public_path() . '/products/';
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/products/'. $fileName;
            $product->image = $fileUri;
        }
        $product->pcategory_id = $request->pcategory_id;
        $slug = Str::slug($request->name);
        $count = DB::table('products')->where('slug', $slug)->where('id', '!=', $product->id)->count();
        $suffix = '';

        if ($count > 0) {
            $suffix = '-' . $count;
        }
        $product->slug = $slug . $suffix;
        $product->save();

        return redirect('/locales-asociados/productos/' . $product->commerce->id)
                ->with('message', 'Producto modificado con éxito!');
    }

    public function productsDestroy($id){
        Product::destroy($id);

        return redirect()
                ->back()
                ->with('message', 'Producto eliminado con éxito!');
    }

    public function jobs($id){
        $commerce = Commerce::find($id);
        
        $jobs = Job::where('commerce_id', $commerce->id)
        ->orderBy('id', 'desc')
        ->get();

        return view('public.localesAsociados.jobs.index', [
            'jobs' => $jobs,
            'commerce' => $commerce
        ]);
    }

    public function jobsStore(Request $request){
        $job = new Job();
        $job->title = $request->title;
        $job->description = $request->description;
        $job->whatsapp_code = $request->whatsapp_code;
        $job->whatsapp_number_code = $request->whatsapp_number_code;
        if($request->whatsapp_number){
            $job->whatsapp_number = ltrim($request->whatsapp_number, '0');
            $job->whatsapp = $this->formatPhoneNumber(str_replace('+', '', $request->whatsapp_number_code), $request->whatsapp_number);
        }else{
            $job->whatsapp_number = NULL;
            $job->whatsapp = NULL;
        }
        $job->commerce_id = $request->commerce_id;
        $job->email = $request->email;

        $slug = Str::slug($request->title);
        $count = DB::table('jobs')->where('slug', $slug)->count();
        $suffix = '';
        if ($count > 0) {
            $suffix = '-' . $count;
        }
        $job->slug = $slug . $suffix;
        $job->save();


        return redirect()->back()->with('message', 'Empleo Publicado con éxito!');
    }

    public function jobsEdit($id){
        $job = Job::find($id);

        return view('public.localesAsociados.jobs.edit', [
            'job' => $job
        ]);
    }
    
    public function jobsUpdate($id, Request $request){
        $job = Job::find($id);
        $slug = Str::slug($request->title);
        $count = DB::table('jobs')->where('slug', $slug)->where('id', '!=', $job->id)->count();
        $suffix = '';

        if ($count > 0) {
            $suffix = '-' . $count;
        }
        
        $job->title = $request->title;
        $job->slug = $slug . $suffix;
        $job->description = $request->description;
        $job->whatsapp_code = $request->whatsapp_code;
        $job->whatsapp_number_code = $request->whatsapp_number_code;
        if($request->whatsapp_number){
            $job->whatsapp_number = ltrim($request->whatsapp_number, '0');
            $job->whatsapp = $this->formatPhoneNumber(str_replace('+', '', $request->whatsapp_number_code), $request->whatsapp_number);
        }else{
            $job->whatsapp_number = $job->whatsapp_number;
            $job->whatsapp = $job->whatsapp;
        }
        $job->email = $request->email;
        $job->save();


        return redirect('/locales-asociados/jobs/' . $job->commerce->id)
                ->with('message', 'Aviso de Empleo modificado con éxito!');
    }

    public function jobsDestroy($id){
        Job::destroy($id);

        return redirect()
                ->back()
                ->with('message', 'Aviso de Empleo  eliminado con éxito!');
    }

    public function horarios($id){
        $commerce = Commerce::find($id);
        $weekdays = Weekday::all();
        $firstDay = $weekdays->shift();
        $weekdays->push($firstDay);
    
        $hours = $commerce->weekdays;
    
        // Obtener los días de la semana de la tabla pivote
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
    
        return view('public.localesAsociados.hours.index', [
            'days' => $days,
            'commerce' => $commerce
        ]);
    }

    public function cambiarHorarios(Request $request){
        $weekday = Weekday::find($request->id);
        $commerce = Commerce::find($request->commerce_id);

        if ($request->is_selected == 'true') {
            $commerce->weekdays()->syncWithoutDetaching([
                $weekday->id => [
                    'hour_open' => $request->hour_open,
                    'minute_open' => $request->minute_open,
                    'hour_close' => $request->hour_close,
                    'minute_close' => $request->minute_close
                ]
            ]);
        } else {
            $commerce->weekdays()->detach($weekday->id);
        }

        return response()->json([
            'message' => 'sincronización exitosa',
            'horario ' => $request->is_selected
        ]);
    
    }

    public function reporteDeVisitas($id, Request $request){
        $commerce = Commerce::find($id);
        
        $visits = Visit::where('commerce_id', $id)            
        ->whereYear('created_at', '=', date('Y'))
        ->get(); 

        $likes = Like::where('commerce_id', $id)->count();

        $primerSemestreData = [];
        $primerSemestreMeses = ['01', '02', '03', '04', '05', '06'];
        $mesesEscritos1 = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'];

        $segundoSemestreData = [];
        $segundoSemestreMeses = ['07', '08', '09', '10', '11', '12'];
        $mesesEscritos2 = ['Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        foreach($primerSemestreMeses as $m){
            $data = Visit::where('commerce_id', $id)
            ->whereMonth('created_at', '=', $m)
            ->whereYear('created_at', '=', date('Y'))
            ->count();

            array_push($primerSemestreData, $data);
        }

        foreach($segundoSemestreMeses as $m){
            $data = Visit::where('commerce_id', $id)
            ->whereMonth('created_at', '=', $m)
            ->whereYear('created_at', '=', date('Y'))
            ->count();

            array_push($segundoSemestreData, $data);        
        }

        return view('public.localesAsociados.visits.index' , [
            'primerSemestreMeses' => $mesesEscritos1,
            'primerSemestreData' => $primerSemestreData,
            'segundoSemestreMeses' => $mesesEscritos2,
            'segundoSemestreData' => $segundoSemestreData,
            'visitasTotales' => $visits->count(),
            'likes' => $likes,
            'commerce' => $commerce
        ]);

    }


}
