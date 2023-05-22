<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\UserNotification;
use App\Mail\EvaluatedMessageRegisterMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNewEvaluatedMessageNotificationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user_notification;
    private $receive_user;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $receive_user, UserNotification $user_notification)
    {
        $this->user_notification = $user_notification;
        $this->receive_user = $receive_user;
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
                ->send(new EvaluatedMessageRegisterMail($this->user_notification));
        } else {
            \Mail::to($this->receive_user->email)
                ->send(new EvaluatedMessageRegisterMail($this->user_notification));
        }
    }
}
