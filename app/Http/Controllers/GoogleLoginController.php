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

        if ($user){ //idが同じユーザーがいる場合
            dd($user);
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
            } else { //メアドが重複しているユーザーがいない場合
                // 画像の保存、画像URLが取得できなかった時の対策でile_get_contentsの前に@をつけている
            $img = @file_get_contents($sns_user->avatar);
            $fileName = null;
            if ($img !== false) {
                $fileName = 'public/icon/' . 'google' . '_' . uniqid() . '.jpg'; //publicがいるかどうか
                \Storage::put($fileName, $img, 'public');
            }
            $user = User::create([
                'email' => $sns_user->email,
                'google_id' => $sns_user->id,
                'email_verified_at' => Carbon::now()
            ]);
            $user->UserProfile->create([
                'icon' => $fileName,
            ]);
        }
                    Auth::login($user);
                    return redirect()->route('user_profile.create');
                // Auth::login($user, true);
            }
        }
}