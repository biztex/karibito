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
        $user = Socialite::driver('google')->user();
        
        // $user_model = User::firstOrCreate([
        //     'name' => $user->name,
        //     'email' => $user->email
        // ], [
        //     'email_verified_at' => now(),
        //     'google_id' => $user->getId()
        // ]);
        $user_model = User::where('google_id', $user->id)->first();
        if (!$user_model) {
            $user_model = new User([
                // 'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id
            ]);

        $user_model->save();

        dd($user);
        Auth::login($user_model, true);
        return redirect('profile/create');
    }
}
    // public function authFacebookCallback()
    // {
    //     $user = Socialite::driver('facebook')->user();
    //     // dd($user); // Facebookから取得した情報を表示

    //     // すでにFacebook登録済みじゃなかったらユーザーを登録する
    //     $user_model = User::where('facebook_id', $user->id)->first();
    //     if (!$user_model) {
    //         $user_model = new User([
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'facebook_id' => $user->id
    //         ]);

    //         $user_model->save();
    //     }
    //     // ログインする
    //     Auth::login($user_model);
    //     // /homeにリダイレクト
    //     return redirect('/mypage');

    // }
}
