<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CouponRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_notification;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_notification)
    {
        $this->user_notification = $user_notification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[カリビト]　あなたがクーポンを取得しました！') //メールタイトル
        ->text('mail.html.coupon_register');
    }
}
