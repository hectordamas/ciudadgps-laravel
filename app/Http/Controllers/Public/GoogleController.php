<?php

namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use App\Models\Commerce;
use DateTime;
use Carbon\Carbon;
use Auth;
use Session;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        Session::put('redirectUri', $request->redirectUri);
        Session::put('mode', $request->mode);

        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }
        
    public function handleGoogleCallback()
    {
        $mode = Session::get('mode');
        $redirectUri = Session::get('redirectUri');

        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->orWhere('email', strtolower($user->email))->first();
       
            if($finduser){
                $finduser->google_id = $user->id;

                if(!$finduser->avatar){
                    $finduser->avatar = $user->avatar;
                }

                $finduser->save();
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => strtolower($user->email),
                    'avatar' => $user->avatar,
                    'google_id'=> $user->id,
                    'password' => bcrypt(random_int(1000000000, 9999999999))
                ]);
      
            }
            $user = $finduser ? $finduser : $newUser;

            if($mode == 'web'){
                Auth::login($user);
                return redirect('home');
            }

            $user = $finduser ? $finduser : $newUser;
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addYears(100);
            $token->save();

            if($user->email){
                $commerce = Commerce::where('user_email', strtolower($user->email))->first();

                if($commerce){
                    $user->commerces()->syncWithoutDetaching([$commerce->id]);
                }
            }

            return redirect()->away($redirectUri . '?token='. $tokenResult->accessToken);
      
        } catch (\Exception $e) {
            if($mode == 'web'){
               return redirect('home');
            }
            return redirect()->away($redirectUri);
        }
    }

}
