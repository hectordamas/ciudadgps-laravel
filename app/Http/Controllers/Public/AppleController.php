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
use App\Models\AppleVariable;

class AppleController extends Controller
{
    public function redirectToApple(Request $request)
    {
        $mode = $request->mode;
        $redirectUri = $request->redirectUri;
        AppleVariable::create(['mode' => $mode, 'redirectUri' => $redirectUri, 'type' => 'login']);
    
        return Socialite::driver('sign-in-with-apple')->scopes(['name', 'email'])->redirect();
    }

    public function handleAppleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('sign-in-with-apple')->user();

            $appleVariables = AppleVariable::orderBy('id', 'desc')->first();
            $mode = $appleVariables->mode;
            $redirectUri = $appleVariables->redirectUri;

            $appleVariables->delete();

            $finduser = User::where('apple_id', $user->id)->orWhere('email', $user->email)->first();
       
            if($finduser){
                $finduser->apple_id = $user->id;

                if(!$finduser->avatar){
                    $finduser->avatar = $user->avatar;
                }

                $finduser->save();
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => strtolower($user->email),
                    'avatar' => $user->avatar,
                    'apple_id'=> $user->id,
                    'password' => bcrypt(random_int(1000000000, 9999999999))
                ]);
            }

            $user = $finduser ? $finduser : $newUser;

            if($mode == 'web'){
                Auth::login($user);
                return redirect('home');
            }
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
        } catch (Exception $e) {
            if($mode == 'web'){
                return redirect('home');
            }
            return redirect()->away($redirectUri);
        }
    }
}
