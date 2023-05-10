<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferFailureMail extends Mailable
{
    use Queueable;
    use SerializesModels;

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
        return $this->subject(\Lang::get('【カリビト】お振り込みに失敗しました。'))
            ->view('mail.text.user.transfer_failure_mail');
    }
}
