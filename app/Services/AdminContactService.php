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
    public function sendMail($request)
    {
        ContactMailHistory::create([
            'name'    => $request->name,
            'mail'    => $request->mail,
            'type'    => "",  // 非表示の為、""を代入
            'message' => $request->message
        ]);
        Mail::to('adminContact@test.com')
            ->send(new ContactMail($request));
    }
}
