<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Code;
use DateTime;
use Carbon\Carbon;
use Auth;
use Response;
use Mail;
use App\Models\Commerce;
use App\Models\CommerceCode;
use App\Http\Controllers\Api\BaseController;

class ComerciosAsociadosController extends BaseController
{
    public function index(Request $request){
        $user = User::find($request->user_id);
        
        // Obtener una consulta de los comercios del usuario
        $commercesQuery = $user->commerces();
        
        // Cargar las historias relacionadas para cada comercio
        $commerces = $commercesQuery
        ->with('stories', function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subDays(1));
        })
        ->get();

        $stories = $commercesQuery
        ->with('stories', function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subDays(1));
        })
        ->has('stories')
        ->orderBy('lastStoryId', 'desc')
        ->get()
        ->take(15);
        
        return response()->json([
            'commerces' => $commerces,
            'stories' => $stories
        ]);
    }
    
    public function solicitarCodigo(Request $request){
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'El Correo Electrónico es obligatorio',
            'email.email' => 'Debes ingresar un correo electrónico válido',
        ]);

        try {
            $email = $request->email;
            $commerce = Commerce::where('user_email', strtolower($email))->first();

            if($commerce){
                $message = '';

                $commerce->commerce_codes()->delete();

                $codeNumber = random_int(100000, 999999);

                $commerce_code = new CommerceCode();
                $commerce_code->code = $codeNumber;
                $commerce_code->commerce_id = $commerce->id;
                $commerce_code->save();

                $data = [ 'code' => $codeNumber, 'commerce' => $commerce];

                Mail::send('mail.asociar', $data , function($message) use ($commerce, $commerce_code, $email){
                    $message->from('no-responder@ciudadgps.com', 'CiudadGPS');
                    $message->to($email)->subject('Tu código para asociar '. $commerce->name .' a tu cuenta de CiudadGPS: ' . strval($commerce_code->code));
                });

                return response()->json([
                    'message' => 'Tú código de verificación ha sido enviado, por favor revisa tu bandeja de entrada para continuar',
                    'commerce_id' => $commerce->id
                ]);
            }

            return response()->json([
                'error' => 'No hay un comercio asociado a este correo'
            ]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function comprobarCodigo(Request $request){
        $codigo = $request->code;
        $commerce_id = $request->commerce_id;
        $commerce = Commerce::find($commerce_id);
        $commerce_code = CommerceCode::where('code', $codigo)
        ->where('commerce_id', $commerce_id)
        ->orderBy('id', 'desc')
        ->first();
        $user = User::find($request->user_id);

        if($commerce_code){

            $user->commerces()->attach($commerce);

            return response()->json([
                'message' => 'Comercio asociado de forma exitosa!',
                'commerce_id' => $commerce_id
            ]);
        }

        return response()->json([
            'error' => 'Código Incorrecto, intente de nuevo!',
            'commerce_id' => $commerce_id
        ]);
    }
}
