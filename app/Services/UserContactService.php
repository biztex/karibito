<?php

namespace App\Services;

use App\Mail\User\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class UserContactService
{
    /**
     * お問い合わせ完了メール送信
     */
    public function sendMail($request)
    {
        if (!isset(Auth::user()->sub_email)) {
            \Mail::to($request->mail)
                ->send(new ContactMail($request));
        } else {
            \Mail::to($request->mail)
                ->cc(Auth::user()->sub_email)
                ->send(new ContactMail($request));
        }
    }
}
