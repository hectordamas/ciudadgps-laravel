<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Commerce;
use App\Models\User;

class UsersController extends Controller
{
    
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('users.index', [
            'users' => $users
        ]);
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = strtolower($request->input('email'));
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->role;
        $user->bio = $request->bio;
        $user->job_position = $request->job_position;
        $user->save();

        if($request->input('email')){
            $commerces = Commerce::where('user_email', strtolower($request->input('email')))->get();
            foreach($commerces as $commerce){
                $user->commerces()->syncWithoutDetaching([$commerce->id]);
            }
        }

        return redirect()->back()->with('message', 'Usuario Creado con éxito');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', [
            'user' => $user
        ]);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = strtolower($request->input('email'));
        if($request->input('password')){
            $user->password = bcrypt($request->input('password'));
        }
        $user->role = $request->role;
        $user->bio = $request->bio;
        $user->job_position = $request->job_position;
        $user->save();

        if($request->input('email')){
            $commerces = Commerce::where('user_email', strtolower($request->input('email')))->get();
            foreach($commerces as $commerce){
                $user->commerces()->syncWithoutDetaching([$commerce->id]);
            }
        }

        return redirect()->back()->with('message', 'Usuario Modificado con éxito');
    }


    public function destroy($id)
    {
        //
    }
    
}
