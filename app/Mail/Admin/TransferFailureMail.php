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

    public $transfer_request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_notification, $transfer_request)
    {
        $this->user_notification = $user_notification;
        $this->transfer_request = $transfer_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(\Lang::get('【カリビト】【重要】お振込み失敗のお知らせ'))
            ->view('mail.text.user.transfer_failure_mail');
    }
}
