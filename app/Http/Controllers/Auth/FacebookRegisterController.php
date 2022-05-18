<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class FacebookRegisterController extends Controller
{
    /**
     * RegistersUsersのregisterオーバーライド
     * twitter_idに不正な値が入ってきた時のエラー処理を追記
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // $facebookIdValidate = \Validator::make($request->all(), [
        //     'facebook_id' => ['required', 'string', 'max:255'],
        // ]);

        // if ($facebookIdValidate->fails()) {
        //     return redirect('/login')->with('flash_alert', '予期せぬエラーが発生しました');
        // }

        // $this->validator($request->all())->validate();

        // event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //             ? new JsonResponse([], 201)
        //             : redirect($this->redirectPath());
    }


    public function form()
    {
        return view('auth.facebook_register');
    }
}
