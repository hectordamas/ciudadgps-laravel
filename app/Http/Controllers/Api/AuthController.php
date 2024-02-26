<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Code;
use DateTime;
use Carbon\Carbon;
use Auth;
use Response;
use Mail;
use App\Models\Commerce;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function signUp(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'email.required' => 'El Correo Electrónico es obligatorio',
            'email.email' => 'Debes ingresar un correo electrónico válido',
            'email.unique' => 'El correo electrónico que ingresaste ya está en uso',
            'password.required' => 'La contraseña es obligatoria.',
        ]);
        try{
            $user =  User::create([
                'name' => $request->name,
                'email' => strtolower($request->email),
                'password' => bcrypt($request->password),
                'role' => 'Usuario'
            ]);
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addYears(100);
            $token->save();

            if($request->email){
                $commerce = Commerce::where('user_email', strtolower($request->email))->first();
                if($commerce){
                    $user->commerces()->syncWithoutDetaching([$commerce->id]);
                }
            }

        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
        return response()->json([
            'message' => 'Usuario registrado con éxito!',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            'user' => $user
        ], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'El Correo Electrónico es obligatorio',
            'email.email' => 'Debes ingresar un correo electrónico válido',
            'password.required' => 'La contraseña es obligatoria.',
        ]);
        try{
            $credentials = request(['password']);
            $credentials['email'] = strtolower(request('email')); // Convertir email a minúsculas
            if (!Auth::attempt($credentials))
                return response()->json(['error' => 'Usuario o contraseña incorrectos'], 401);
    
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
    
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addYears(100);
            $token->save();
            
        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            'user' => $user
        ]);
    }

    public function logout(Request $request){
        try{
            $request->user()->token()->revoke();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'Sesión cerrada de forma exitosa!'
        ]);
    }

    public function user(Request $request){
        try{
            return response()->json($request->user());
        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
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
            $user = User::where('email', strtolower($email))->first();

            if($user){
                $message = '';
                if($user->google_id){ 
                    $message = 'Debes entrar a tráves de tu cuenta de Google';  
                    return response()->json([
                        'error' => $message
                    ]);
                }  
                if($user->facebook_id){
                    $message = 'Debes entrar a tráves de tu cuenta de Facebook';
                    return response()->json([
                        'error' => $message
                    ]);
                }

                $user->codes()->delete();

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
                    'message' => 'Tú código de verificación ha sido enviado, por favor revisa tu bandeja de entrada para continuar',
                    'user_id' => $user->id
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
        $code = Code::where('code', $codigo)
        ->where('user_id', $user_id)
        ->orderBy('id', 'desc')
        ->first();

        if($code){
            return response()->json([
                'message' => 'Código Verificado de forma exitosa!',
                'user_id' => $user_id
            ]);
        }

        return response()->json([
            'error' => 'Código Incorrecto, intente de nuevo!',
            'user_id' => $user_id
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
        
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addYears(100);
        $token->save();

        return response()->json([
            'message' => 'Contraseña modificada con éxito',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            'user' => $user
        ]);
    }

}
