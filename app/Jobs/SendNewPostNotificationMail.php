<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\PostRegisterMail;
use App\Models\UserNotification;

class SendNewPostNotificationMail implements ShouldQueue
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
        \Mail::to($this->user_notification->user->email)->send(new PostRegisterMail($this->user_notification));
    }
}
