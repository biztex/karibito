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
        return Socialite::driver('google')->redirect();
    }


    public function authGoogleCallback()
    {
        $sns_user = Socialite::driver('google')->stateless()->user();
        // dd($sns_user);
        $user = User::where('google_id', $sns_user->id)->first();
        // $user = User::where('email', $google_user->email)->first();
        if ($user){
            Auth::login($user);
            return redirect()->route('user_profile.create');
        } else {
            // $user = User::where('google_id', $google_user->id)->first();
            $duplicate_email_user = User::where('email', $sns_user->email)->first();
            if($duplicate_email_user) {
                if(is_null($duplicate_email_user->email_verified_at)) {
                    $duplicate_email_user->email_verified_at = Carbon::now();
                }

                $duplicate_email_user->google_id = $sns_user->id;
                $duplicate_email_user->save();
            } else {
                $user = User::create([
                    'email' => $sns_user->email,
                    'google_id' => $sns_user->id,
                    'email_verified_at' => Carbon::now()
                ]);
                $user = UserProfile::create([
                    'icon' => $sns_user->avator,
                ]);
            }
                    Auth::login($user);
                    return redirect()->route('user_profile.create');
                // Auth::login($user, true);
            }
        }

}