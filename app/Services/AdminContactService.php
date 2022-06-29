<?php

namespace App\Services;

use App\Models\ContactMailHistory;
use App\Mail\Admin\ContactMail;
use Illuminate\Support\Facades\Mail;

class AdminContactService
{
    /**
     * お問い合わせ完了メール送信
     */
    public static function sendMail($request)
    {
        ContactMailHistory::create([
            'name'    => $request->name,
            'mail'    => $request->mail,
            'type'    => $request->type,
            'message' => $request->message
        ]);
        Mail::to('adminContact@test.com')
            ->send(new ContactMail($request));
    }
}
