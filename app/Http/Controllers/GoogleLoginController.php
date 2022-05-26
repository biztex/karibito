<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        $uraal = url()->previous('');
        return Socialite::driver('google')->redirect();
    }

    public function authGoogleCallback()
    {
        $sns_user = Socialite::driver('google')->stateless()->user();
        dd($uraal);

        $user = User::where('google_id', $sns_user->id)->first();
        // echo url()->previous();
        // if(url()->previous() = '')
        if ($user){ //idが同じユーザーがいる場合
            Auth::login($user);
            return redirect()->route('user_profile.create');
        } else {  //idが同じユーザーがいない場合
            $duplicate_email_user = User::where('email', $sns_user->email)->first();
            if($duplicate_email_user) { //メアドが重複しているユーザーがいる場合
                if(is_null($duplicate_email_user->email_verified_at)) {
                    $duplicate_email_user->email_verified_at = Carbon::now();
                }

                $duplicate_email_user->google_id = $sns_user->id;
                $duplicate_email_user->save();
            } else { //メアドが重複しているユーザーがいない場合
            $user = User::create([
                'email' => $sns_user->email,
                'google_id' => $sns_user->id,
                'google_token' => $sns_user->token,
                'email_verified_at' => Carbon::now()
            ]);
        }
                    Auth::login($user);
                    return redirect()->route('user_profile.create');
                // Auth::login($user, true);
            }
        }
}