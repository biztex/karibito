<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Socialite;
use Socialite;

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
        $userModel = User::where('facebook_id', $user->id)->first();
        if (!$userModel) {
            $userModel = new User([
                'name' => $user->name,
                'email' => $user->email,
                'facebook_id' => $user->id
            ]);

            $userModel->save();
        }
        // ログインする
        Auth::login($userModel);
        // /homeにリダイレクト
        return Redirect::route('home');
        return redirect('/mypage');

    }
}
