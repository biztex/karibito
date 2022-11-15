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
        // 商品IDかリクエストIDが渡ったらの分岐
        // 渡ってきた値をmessageと結合して変数に格納
        if ($request->product_id) {
            $message = "商品ID:" . $request->product_id;
        } else {
            $message =  "ジョブリクエストID:" . $request->job_request_id;
        }

        $message = $message . " " . $request->message;

        $request->product = $message;
        ContactMailHistory::create([
            'name'    => $request->name,
            'mail'    => $request->mail,
            'type'    => $request->type,
            'message' => $message
        ]);
        Mail::to('adminContact@test.com')
            ->send(new ContactMail($request));
    }
}
