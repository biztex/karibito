<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;


class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 認証メール最終送信日時取得
        $user = User::find(\Auth::id());
        
        $verifyemail_send_at = strtotime($user->verifyemail_send_at);
        $now = time();

        if ($request->user()->hasVerifiedEmail()) {

            return redirect()->intended(RouteServiceProvider::HOME);

        } elseif($now - $verifyemail_send_at < 60) {
            // 最終送信日時より60秒経過していなかったらエラー
            \Session::put('send_msg',null);
            \Session::put('error_msg','時間をおいてから再度お試しください。'); 
            return redirect()->route('verification.notice');

        }
            \Session::put('error_msg',null);
            \Session::put('send_msg','メールを送信しました。'); 
            // 最終送信日時を更新して認証メール送信
            $user->fill([ 'verifyemail_send_at' => Carbon::now() ])->save();
            // シェアされたurlであればクエリパラメータに紹介者のidが含まれる
            $introduced_user_id = $request->input('introduced_user_id');
            $request->user()->sendEmailVerificationNotification($introduced_user_id);

        return back()->with('status', 'verification-link-sent');

    }
}