<?php

namespace App\Services;

use App\Mail\ChangeEmailMail;
use App\Models\EmailReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ChangeEmailService
{
    /**
     * トークンの有効期限(30分)
     */
    const TOKEN_EXPIRES = 60 * 30;


    public function sendChangeEmailLink($request)
    {
        $new_email = $request->email;

        // トークン生成
        $token = hash_hmac(
            'sha256',
            \Str::random(40) . $new_email,
            config('app.key')
        );
        // トークンをDBに保存
        \DB::beginTransaction();
        try {

            $email_reset = EmailReset::create([
                'user_id' => \Auth::id(),
                'new_email' => $new_email,
                'token' => $token,
            ]);
            \DB::commit();

            if (!isset(Auth::user()->sub_email)) {
                \Mail::to($new_email)->send(new ChangeEmailMail($token));
            } else {
                \Mail::to($new_email)
                    ->cc(Auth::user()->sub_email)
                    ->send(new ChangeEmailMail($token));
            }

            return true;
        } catch (\Exception $e) {
            \DB::rollback();

            return false;
        }
    }

    public function updateEmail($token)
    {
        // トークンから新しいメールアドレスとユーザーIDが入っているレコードを取得
        $email_resets = EmailReset::where('token', $token)->first();

        // トークンが存在していて、かつ、有効期限が切れていないかチェック
        if ($email_resets && !$this->tokenExpired($email_resets->created_at)) {

            // ユーザーのメールアドレスを更新
            $user = User::find($email_resets->user_id);
            $user->email = $email_resets->new_email;
            $user->save();

            // レコードを削除
            $email_resets->delete();

            return true;
        } else {
            // レコードが存在していた場合削除
            if ($email_resets) {
                $email_resets->delete();
            }

            return false;
        }
    }

    /**
     * トークンが有効期限切れかどうかチェック
     *
     * @param  string  $createdAt
     * @return bool
     */
    protected function tokenExpired($createdAt)
    {
        return Carbon::parse($createdAt)->addSeconds(static::TOKEN_EXPIRES)->isPast();
    }
}
