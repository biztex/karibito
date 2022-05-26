<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class FacebookLoginController extends Controller
{
    public function getFacebookAuth()
    {
        if(request()->is('*login*')) {
            session()->flash('via_oauth', 'login');
        } else {
            session()->flash('via_oauth', 'register');
        }
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function authFacebookCallback()
    {
        // TODO 汎用的な変数名に変更する
        // コメントを書く
        // メソッドで小さく区切る、クラス内で呼び出して使用する
        $sns_user = Socialite::driver('facebook')->stateless()->user();
        dd($sns_user);

        if(is_null($sns_user->email)){ //未確認、開発環境で確認できなかった
            return back()->with('flash_alert', 'フェイスブックにメールアドレスが登録されていませんでした。フェイスブックでメールアドレスを登録するか、メールアドレスで新規登録してください。');
        }
        // すでにFacebook登録済みじゃなかったらユーザーを登録する
        $user = User::where('facebook_id', $sns_user->id)->first();


        if ($user){
            Auth::login($user);
            return redirect()->route('user_profile.create');
        } else {
            if(session()->get('via_oauth') === 'login') {
                return redirect()->route('login')->with('flash_alert','ログイン情報が登録されていません。');
            }
            $duplicate_email_user = User::where('email', $sns_user->email)->first();

            if($duplicate_email_user) {
                if(is_null($duplicate_email_user->email_verified_at)) {
                    $duplicate_email_user->email_verified_at = Carbon::now();
                }
                $duplicate_email_user->facebook_id = $sns_user->id;
                $duplicate_email_user->save();

            } else {
                $user = \DB::transaction(function () use ($sns_user) {
                $user = User::create([
                    'name' => $sns_user->name,
                    'email' => $sns_user->email,
                    'email_verified_at' => Carbon::now(),
                    'facebook_id' => $sns_user->id,
                    // 'facebook_token' => $sns_user->token
                ]);
                $img = @file_get_contents($sns_user->avatar);
                    $file_name = null;
                    if ($img !== false) {
                        $file_name = 'icons/' . 'google' . '_' . uniqid() . '.jpg';
                        \Storage::put('public/' . $file_name, $img, 'public');
                        UserProfile::create([
                            'user_id' => $user->id,
                            'icon' => $file_name
                        ]);
                    }
                });
                return $user;
            }
            // ログインする
            Auth::login($user);
            // /基本情報登録画面にリダイレクト
            return redirect()->route('user_profile.create');
        }
    }
}