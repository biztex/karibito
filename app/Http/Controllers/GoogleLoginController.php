<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
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
        $user = Socialite::driver('google')->stateless()->user();
        $user_model = User::where('google_id', $user->id)->first();
        if (!$user_model) {
                $user_model = new User([
                    'email' => $user->email,
                    'google_id' => $user->id
                ]);
            $user_model->save();
            }

        Auth::login($user_model, true);
        return redirect()->route('user_profile.create');
    }

}
