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
            $report_message = "通報した商品ID:" . $request->product_id;
        } elseif ($request->job_request_id) {
            $report_message =  "通報したジョブリクエストID:" . $request->job_request_id;
        }

        if (isset($report_message)) {
            $request->message = '[' . $report_message . "]" . $request->message;
        }

        ContactMailHistory::create([
            'name'    => $request->name,
            'mail'    => $request->mail,
            'type'    => $request->type,
            'message' => $request->message
        ]);
        Mail::to(config('mail.info_karibito'))
            ->send(new ContactMail($request));
    }
}
