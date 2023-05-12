<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\UserNotification;
use App\Mail\User\GetCouponMail;

class SendNewCouponNotificationMail implements ShouldQueue
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
                ->send(new GetCouponMail($this->user_notification->user->userProfile));
        } else {
            \Mail::to($this->user_notification->user->email)
                ->send(new GetCouponMail($this->user_notification->user->userProfile));
        }
    }
}
