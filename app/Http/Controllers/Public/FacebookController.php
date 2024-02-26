<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use App\Models\Commerce;
use Carbon\Carbon;
use Auth;
use Session;

class FacebookController extends Controller
{
    public function redirectToFacebook(Request $request){
        Session::put('mode', $request->mode);
        Session::put('redirectUri', $request->redirectUri);

        return Socialite::driver('facebook')->asPopup()->redirect();
    }
        
    public function handleFacebookCallback(){
        $mode = Session::get('mode');
        $redirectUri = Session::get('redirectUri');
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)
            ->orWhere('email', $user->email)->first();
       
            if($finduser){
                $finduser->facebook_id = $user->id;

                if(!$finduser->avatar){
                    $finduser->avatar = $user->avatar;
                }

                $finduser->save();
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => strtolower($user->email),
                    'avatar' => $user->avatar,
                    'facebook_id'=> $user->id,
                    'password' => bcrypt(random_int(1000000000, 9999999999))
                ]);
            }

            $user = $finduser ? $finduser : $newUser;

            if($user->email){
                $commerce = Commerce::where('user_email', strtolower($user->email))->first();

                if($commerce){
                    $user->commerces()->syncWithoutDetaching([$commerce->id]);
                }
            }

            if($mode == 'web'){
                Auth::login($user);
                return redirect('home');
            }
      
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addYears(100);
            $token->save();

            return redirect()->away($redirectUri . '?token='. $tokenResult->accessToken);
        } catch (Exception $e) {
            return redirect()->away($redirectUri);
        }
    }

}
