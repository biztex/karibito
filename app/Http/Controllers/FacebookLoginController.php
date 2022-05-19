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
        $facebook_user = Socialite::driver('facebook')->user();
        dd($facebook_user);
        // すでにFacebook登録済みじゃなかったらユーザーを登録する
        $user = User::where('facebook_id', $facebook_user->id)->first();

        if ($user){
            Auth::login($user);
            return redirect()->route('user_profile.create');
        } else {
            $duplicate_email_user = User::where('email', $facebook_user->email)->first();

            if($duplicate_email_user) {
                if(is_null($duplicate_email_user->email_verified_at)) {
                    $duplicate_email_user->email_verified_at = Carbon::now();
                }
                $duplicate_email_user->facebook_id = $facebook_user->id;
                $duplicate_email_user->save();

            } else if(is_null($facebook_user->email)){
                return redirect('/login')->with('error_msg', 'フェイスブックにメールアドレスが登録されていませんでした。フェイスブックでメールアドレスを登録するか、メールアドレスで新規登録してください。');

            } else {
                $user = User::create([
                    'name' => $facebook_user->name,
                    'email' => $facebook_user->email,
                    'email_verified_at' => Carbon::now(),
                    'facebook_id' => $facebook_user->id
                ]);
            }
            // ログインする
            Auth::login($user);
            // /基本情報登録画面にリダイレクト
            return redirect()->route('user_profile.create');
        }
    }
}