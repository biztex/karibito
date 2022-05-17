<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class FacebookLoginController extends Controller
{
    public function getFacebookAuth()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function authFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // すでにFacebook登録済みじゃなかったらユーザーを登録する
        $user_model = User::where('facebook_id', $user->id)->first();
        if (!$user_model) {
            $user_model = new User([
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => Carbon::now(),
                'facebook_id' => $user->id
            ]);
        if(!$user->email){
            return redirect()
                        ->route('register.facebook.form')
                        ->with([
                            'name' => $user->name,
                            'email' => $user->email,
                            'facebook_id' => $user->id
                        ]);
                }

            $user_model->save();
            // ログインする
            Auth::login($user_model);
            // /基本情報登録画面にリダイレクト
            return redirect()->route('user_profile.create');
        } else{
            Auth::login($user_model);
            return redirect()->route('user_profile.create');
        }
    }
}
