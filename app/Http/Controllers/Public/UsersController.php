<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Commerce;
use App\Models\User;

class UsersController extends Controller
{
    public function mi_cuenta(){
        $user = Auth::user();

        return view('public.users.mi_cuenta', [
            'user' => $user
        ]);
    }

    public function update($id, Request $request){
        if(Auth::id() != $id){
            return redirect()->back();
        }
        $user =  User::find($id);
        $user->name = $request->name;
        $user->email = strtolower($user->email);
        if($request->password){ 
            $user->password = $request->password;
        }

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $path = public_path(). '/avatars/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/avatars/'. $fileName;
            $user->avatar = $fileUri;
        }

        $user->save();

        return redirect()->back()->with('message', 'Tus datos se han modificado con éxito!');
    }


    public function favoritos(){
        $id = Auth::id();
    
        $commerces = Commerce::from('commerces as c')
        ->select('c.id','c.name', 'c.rating', 'c.logo', 'c.info')
        ->join('likes as l', 'l.commerce_id', '=', 'c.id')
        ->where('l.user_id', $id)
        ->without(['created_at', 'updated_at', 'imgs'])
        ->orderBy('l.id', 'desc')
        ->paginate(10);

        return view('public.users.favoritos', [
            'commerces' => $commerces
        ]);
    }
}
