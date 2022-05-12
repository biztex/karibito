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

        return redirect('/mypage');

    }
}
