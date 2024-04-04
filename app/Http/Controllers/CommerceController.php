<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commerce;
use App\Models\Img;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Story;
use App\Models\User;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use Auth;

class CommerceController extends Controller
{

    private function formatPhoneNumber($country_code, $phone_number) {
      $phone_number = preg_replace('/[^0-9]/', '', $phone_number); // Remover cualquier caracter que no sea número
      $phone_number = ltrim($phone_number, '0'); // Remover el cero inicial si lo hay
    
      if (substr($phone_number, 0, strlen($country_code)) != $country_code) {
        $phone_number = $country_code . $phone_number; // Agregar el código del país si no está presente
      }
    
      return $phone_number;
    }

    public function filter(Request $request){
        $categories = Category::all();
        $users = User::where('role', "Administrador")->get();

        return view('commerces.filter', [
            'categories' => $categories,
            'users' => $users
        ]);
    }

    public function index(Request $request)
    {
        $commerces = Commerce::range($request->from, $request->to)
        ->searchByCategory($request->category)
        ->searchByname($request->name)
        ->searchByCreatedBy($request->created_by)
        ->searchByExpirationDate($request->expirationFrom, $request->expirationTo)
        ->searchByStatus($request->paid)
        ->orderBy('id', 'desc')
        ->get();
    
        return view('commerces.index', [
            'commerces' => $commerces
        ]);

    }


    public function create()
    {
        $categories = Category::all();

        return view('commerces.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $commerce = new Commerce();
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
        $commerce->info = $request->input('info');
        $commerce->rif = $request->rif;
        $commerce->excerpt = $request->excerpt;
        $commerce->paid = $request->paid;
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

        $commerce->instagram = $request->instagram;
        $commerce->web = $request->web;    
    
        $commerce->payment = 'Efectivo';
        $commerce->category_id = $request->categories[0];

        $commerce->position = $request->position;
        $commerce->destacar = $request->destacar;
        $commerce->expiration_date = $request->expiration_date;

        $commerce->twitter = $request->twitter;
        $commerce->youtube = $request->youtube;
        $commerce->address = $request->address;
        $commerce->created_by = Auth::user()->name;
        $commerce->hide = $request->hide;

        $commerce->url = $request->url;
        $commerce->urlName = $request->urlName;

        $commerce->save();

        if(isset($request->tags)){
            for($i = 0; count($request->tags) > $i; $i++){
                $tag = new Tag();
                $tag->name = $request->tags[$i];
                $tag->commerce_id = $commerce->id;
                $tag->save();
            }
        }

        if(isset($request->categories)){
            $commerce->categories()->sync($request->categories);
        }
        
        if($commerce->user_email){
            $user = User::where('email', strtolower($commerce->user_email))->first();

            if($user){
                $user->commerces()->syncWithoutDetaching([$commerce->id]);
            }
        }

        return response()->json([
            'message' => "Comercio modificado con éxito!",
            'commerce' => $commerce,
        ]);
    }


    public function edit($id)
    {
        $commerce = Commerce::find($id);
        $categories = Category::all();
        return view('commerces.edit', [
            'commerce' => $commerce,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $commerce = Commerce::find($id);

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
        $commerce->info = $request->input('info');
        $commerce->lat = $request->lat;   
        $commerce->lon = $request->lon;

        $commerce->excerpt = $request->excerpt;
        $commerce->rif = $request->rif;
        $commerce->paid = $request->paid;
            
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
        $commerce->instagram = $request->instagram;
        $commerce->web = $request->web;    

        $commerce->twitter = $request->twitter;
        $commerce->youtube = $request->youtube;
        $commerce->address = $request->address;

        $commerce->payment = 'Efectivo';
        $commerce->category_id = $request->categories[0];

        $commerce->position = $request->position;
        $commerce->destacar = $request->destacar;
        $commerce->expiration_date = $request->expiration_date;

        $commerce->created_by = Auth::user()->name;
        $commerce->hide = $request->hide;

        $commerce->url = $request->url;
        $commerce->urlName = $request->urlName;
        
        $commerce->save();

        $commerce->tags()->delete();
        if(isset($request->tags)){
            for($i = 0; count($request->tags) > $i; $i++){
                $tag = new Tag();
                $tag->name = $request->tags[$i];
                $tag->commerce_id = $commerce->id;
                $tag->save();
            }
        }

        if($request->categories){
            $commerce->categories()->sync($request->categories);
        }

        if($commerce->user_email){
            $user = User::where('email', strtolower($commerce->user_email))->first();

            if($user){
                $user->commerces()->syncWithoutDetaching([$commerce->id]);
            }
        }

        return response()->json([
            'message' => "Comercio modificado con éxito!",
            'commerce' => $commerce,
        ]);

    }

    public function imagesUpload(Request $request){
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = public_path(). '/photos/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/photos/'. $fileName;

            $image = new Img();
            $image->uri = $fileUri;
            $image->commerce_id = $request->commerce_id;
            $image->save();
        }

        return response()->json([
            'success' => 'Imagen subida con éxito'
        ]);
    }

    public function imagesDestroy($id){
        Img::destroy($id);

        return response()->json([
            'message' => 'Imagen eliminada con éxito'
        ]);
    }

    public function action(Request $request){
        if(isset($request->check)){
            for($i = 0; $i < count($request->check); $i++){
                $commerce = Commerce::find($request->check[$i]);
                if($request->accion == 'pagado'){
                    $commerce->paid = 'Y';
                    $commerce->save();
                }else if($request->accion == 'eliminar'){
                    $commerce->imgs()->delete();
                    $commerce->comments()->delete();
                    $commerce->likes()->delete();
                    $commerce->tags()->delete();
                    $commerce->visits()->delete();
                    $commerce->commerce_codes()->delete();
                    $commerce->users()->detach();
                    $commerce->categories()->detach();
                    $commerce->delete();
                }else{
                    $commerce->paid = NULL;
                    $commerce->save();
                }
            }
        }

        return redirect()->back()->with('message', 'Comercios modificados con éxito');
    }

}
