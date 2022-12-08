<?php

namespace App\Jobs;

use App\Mail\DmRegisterMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\UserNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNewDmNotificationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $receive_user;
    private $user_notification;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $receive_user, UserNotification $user_notification)
    {
        $this->receive_user = $receive_user;
        $this->user_notification = $user_notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->receive_user->sub_email) {
            \Mail::to($this->receive_user->email)
                ->cc($this->receive_user->sub_email)
                ->send(new DmRegisterMail($this->user_notification));
        } else {
            \Mail::to($this->receive_user->email)
                ->send(new DmRegisterMail($this->user_notification));
        }
    }
}
