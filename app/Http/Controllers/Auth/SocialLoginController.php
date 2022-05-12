<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialLoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';




    /**
     * OAuth認証先にリダイレクト
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider,$type='user')
    {

        session(['type' => $type]);

        return Socialite::driver($provider)->redirect();
    }



    /**
     * ユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request,$provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch(\Exception $e) {
            dump('errorが発生しました');
            return redirect('/')->with('flash_alert', '予期せぬエラーが発生しました');
        }


        if (!$email = $user->getEmail()){
            abort(403, 'アカウントのEmailアドレスが未登録の為、新規登録が実行出来ません。<br>通常の新規登録より登録をお願い致します。');
        }

        $authUser = SocialRegister::where('social_id', $user->id)->first();
        $checkEmail = User::where('email', $user->email)->first();

        if($checkEmail && !$authUser){
            abort(403, 'Emailアドレスが登録済みの為、新規登録が実行出来ません');
        }

        $checkUser = $this->findOrCreateUser($user,$provider,$request);

        session()->forget('a8');
        session()->forget('campaign');
        Cookie::queue(Cookie::forget('a8'));
        Cookie::queue(Cookie::forget('campaign'));

        if(Auth::attempt(['email' => $user->email, 'password' => $user->id], true)){
            return redirect()->intended('/home');
        }

    }







}


