<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address')) // 送信元
        ->subject('メールアドレス変更のお知らせ') // メールタイトル
        ->view('mail.html.change_email') // メール本文のテンプレート
        ->with(['url' => config('app.url') . '/email/' . $this->token]);  // withでセットしたデータをviewへ渡す
    }
}
