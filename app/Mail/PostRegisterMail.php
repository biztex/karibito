<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostRegisterMail extends Mailable
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
        return $this->subject('[カリビト]　あなたがフォローしているユーザーが新しい投稿をしました！') //メールタイトル
        ->text('mail.html.post_register');
    }
}
