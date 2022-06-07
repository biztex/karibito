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
        if(request()->is('*login*')) {
            session()->flash('via_oauth', 'login');
        } else {
            session()->flash('via_oauth', 'register');
        }
        return Socialite::driver('google')->redirect();
    }

    public function authGoogleCallback()
    {
        // 各SNSから当該ユーザー情報を取得
        try {
            $sns_user = Socialite::driver('google')->stateless()->user();
        } catch(\Exception $e) {
            dd($e->getMessage());

            return redirect('/register')->with('flash_alert', '予期せぬエラーが発生しました');
        }

        // $sns_user = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id', $sns_user->id)->first();

        if($user){ //idが同じユーザーがいる場合
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
                Auth::login($duplicate_email_user);
                return redirect()->route('user_profile.create');
            } else { //メアドが重複しているユーザーがいない場合
                if(session()->get('via_oauth') === 'login') {
                    return redirect()->route('login')->with('flash_alert', 'ログイン情報が登録されていません。');
                }
                $user = \DB::transaction(function () use ($sns_user) {
                    $user = User::create([
                        'email' => $sns_user->email,
                        'google_id' => $sns_user->id,
                        // 'google_token' => $sns_user->token,
                        'email_verified_at' => Carbon::now()
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
                    return $user;
                });

                Auth::login($user);
                return redirect()->route('user_profile.create');
            }
        }
    }
}