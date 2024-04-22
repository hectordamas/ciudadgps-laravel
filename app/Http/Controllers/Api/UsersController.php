<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Commerce;
use App\Models\Comment;
use App\Models\Like;
use Carbon\Carbon;
use App\Models\PushToken;

class UsersController extends Controller
{
    public function edit($id, Request $request){
        if($id != $request->user()->id){
            return response()->json([
                'error' => 'usuario invalido'
            ]);
        }

        $user = User::find($id);

        return response()->json([
            'user' => $user
        ]);
    }

    public function update($id, Request $request){
        if($id != $request->user()->id){
            return response()->json([
                'error' => 'usuario invalido'
            ]);
        }

        $request->validate([
            'email' => 'unique:users',
        ], [
            'email.unique' => 'El correo electrónico que ingresaste ya está en uso por otro usuario',
        ]);

        $user = User::find($id);
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $path = public_path(). '/avatars/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/avatars/'. $fileName;
            $user->avatar = $fileUri;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Datos Modificados con éxito!',
            'user' => $user
        ]);
    }

    public function destroy($id, Request $request){
        if($id != $request->user()->id){
            return response()->json([
                'error' => 'usuario invalido'
            ]);
        }

        $user = User::find($id);
        foreach($user->comments as $comment){
            $commerce = Commerce::find($comment->commerce_id);
            $comment->delete();

            $totalRating = 0;
            foreach($commerce->comments as $c){
                $totalRating = $totalRating + $c->rating;
            }

            if($commerce->comments->count() > 0){
                $totalRating = $totalRating / $commerce->comments->count();
                $commerce->rating = $totalRating;
            }
            $commerce->save();
        }

        foreach($user->likes as $like){
            $like->delete();
        }

        $user->delete();


        return response()->json([
            'message' => 'Datos Elimnados con éxito!',
            'user' => $user
        ]);
    }

    public function avatarUpdate($id, Request $request){
        if($id != $request->user()->id){
            return response()->json([
                'error' => 'usuario invalido'
            ]);
        }

        $user = User::find($id);

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $path = public_path() . '/avatars/';
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/avatars/' . $fileName;
            $user->avatar = $fileUri;
        }
        $user->save();

        $user = User::find($id);

        return response()->json([
            'user' => $user
        ]);
    }

    public function setToken(Request $request) {
        $tokenValue = $request->token;
        $existingToken = PushToken::where('token', $tokenValue)->first();

        if(!$tokenValue){
            return response()->json([
                'message' => 'El token es nulo, por lo tanto no puede almacenarse',
                'token' => $tokenValue
            ]);
        }
    
        if ($existingToken) {
            return response()->json([
                'message' => 'El token ya está almacenado en la base de datos',
                'token' => $tokenValue
            ]);
        }
    
        if ($request->userId) {
            $user = User::find($request->userId);
            $user->token = $tokenValue;
            $user->save();    
        } else {
            $token = new PushToken();
            $token->token = $tokenValue;
            $token->save();
        }
    
        return response()->json([
            'message' => 'Token almacenado con éxito',
            'token' => $tokenValue
        ]);
    }

    public function setGenderAndBirthday(Request $request){
        try {
            $user = User::find($request->userId);
            $user->gender = $request->gender;
            // Formatear la fecha antes de almacenarla
            $formattedDate = Carbon::parse($request->selectedDate)->format('Y-m-d H:i:s');
            $user->birthday = $formattedDate;            
            $user->save();
    
            return response()->json([
                'message' => 'informacion almacenada con exito',
                'user' => $user
            ]);              
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}