<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\Admin\TransferFailureMail;
use App\Models\UserNotification;

class SendTransferFailureMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_notification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserNotification $user_notification)
    {
        $this->user_notification = $user_notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->user_notification->user->sub_email) {
            \Mail::to($this->user_notification->user->email)
                ->cc($this->user_notification->user->sub_email)
                ->bcc(config('mail.info_bcc')) //todo:メールトラップでは確認できないため、本番で確認する
                ->send(new TransferFailureMail($this->user_notification));
        } else {
            \Mail::to($this->user_notification->user->email)
                ->bcc(config('mail.info_bcc')) //todo:メールトラップでは確認できないため、本番で確認する
                ->send(new TransferFailureMail($this->user_notification));
        }
    }
}