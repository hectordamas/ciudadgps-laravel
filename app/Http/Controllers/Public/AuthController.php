<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Mail;
use App\Models\User;
use App\Models\Code;


class AuthController extends Controller
{
    public function solicitarCodigo(Request $request){

        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'El Correo Electrónico es obligatorio',
            'email.email' => 'Debes ingresar un correo electrónico válido',
        ]);

        try {

            $email = strtolower($request->email);
            $user = User::where('email', $email)->first();

            if($user){
                $message = '';
                if($user->google_id){ 
                    $message = 'Debes entrar a tráves de tu cuenta de Google';  

                    return response()->json(['error' => $message]);
                }  
                if($user->facebook_id){
                    $message = 'Debes entrar a tráves de tu cuenta de Facebook';

                    return response()->json(['error' => $message]);
                }

                foreach($user->codes as $c){
                    $c->delete();
                }

                $codeNumber = random_int(100000, 999999);

                $code = new Code();
                $code->code = $codeNumber;
                $code->user_id = $user->id;
                $code->save();

                $data = [ 'code' => $codeNumber];

                Mail::send('mail.reset', $data , function($message) use ($user, $code){
                    $message->from('no-responder@ciudadgps.com', 'CiudadGPS');
                    $message->to($user->email)->subject('Tu código para reestablecer tu cuenta de CiudadGPS: ' . strval($code->code));
                });

                return response()->json([
                    'message' => 'Tú código de verificación ha sido enviado, por favor revisa tu bandeja de entrada para continuar.',
                    'user' => $user
                ]);
            }

            return response()->json([
                'error' => 'No hay un usuario asociado a este correo'
            ]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function comprobarCodigo(Request $request){
        $codigo = $request->code;
        $user_id = $request->user_id;
        $user = User::find($user_id);
        $code = Code::where('code', $codigo)
        ->where('user_id', $user_id)
        ->orderBy('id', 'desc')
        ->first();

        if($code){
            Auth::login($user);

            return response()->json([
                'message' => 'Código Verificado de Forma exitosa!'
            ]);
        }

        return response()->json([
            'error' => 'Código Inválido, intente de nuevo'
        ]);
    }

    public function password(){
        $user = Auth::user();

        return view('public.reset.password', [
            'user' => $user
        ]);
    }

    public function cambiarContraseña(Request $request){
        $user_id = $request->user_id;
        $password = $request->password;
        $user = User::find($user_id);
        if($password){
            $user->password = bcrypt($password);
        }
        $user->save();

        Auth::login($user);

        Session::flash('message', 'Tu cuenta ha sido restaurada con éxito');

        return redirect('/home');
    }
}
