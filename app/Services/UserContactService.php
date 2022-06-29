<?php

namespace App\Services;

use App\Mail\User\ContactMail;
use Illuminate\Support\Facades\Mail;

class UserContactService
{
    /**
     * お問い合わせ完了メール送信
     */
    public static function sendMail($request)
    {
        Mail::to($request->mail)
            ->send(new ContactMail($request));
    }
}
