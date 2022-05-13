<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        // dd($user); // Facebookから取得した情報を表示

        // すでにFacebook登録済みじゃなかったらユーザーを登録する
        $user_model = User::where('facebook_id', $user->id)->first();
        if (!$user_model) {
            $user_model = new User([
                'name' => $user->name,
                'email' => $user->email,
                'facebook_id' => $user->id
            ]);

            $user_model->save();
        }
        // ログインする
        Auth::login($user_model);
        // /基本情報登録画面にリダイレクト
        return redirect('createUser');

    }
}
