<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        return Socialite::driver('google')->redirect();
    }


    public function authGoogleCallback()
    {
        $google_user = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $google_user->email)->first();
        if ($user){
            $user->google_id = $google_user->id;
            $user->save();
        } else {
            $user = User::where('google_id', $google_user->id)->first();
            if (!$user) {
                $user = new User([
                    'email' => $google_user->email,
                    'google_id' => $google_user->id,
                    'email_verified_at' => Carbon::now()
                ]);
                $user->save();
                Auth::login($user, true);
                return redirect()->route('user_profile.create');
            } else {
                Auth::login($user);
                return redirect()->route('mypage.showMypage');
            }
        }
    }
}