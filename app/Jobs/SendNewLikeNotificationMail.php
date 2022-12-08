<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\LikeRegisterMail;
use App\Models\UserNotification;
use Illuminate\Queue\SerializesModels;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNewLikeNotificationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $product_user;
    private $mail_content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $product_user, UserNotification $mail_content)
    {
        $this->mail_content = $mail_content;
        $this->product_user = $product_user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->product_user->sub_email) {
            \Mail::to($this->product_user->email)
                ->cc($this->product_user->sub_email)
                ->send(new LikeRegisterMail($this->mail_content));
        } else {
            \Mail::to($this->product_user->email)
                ->send(new LikeRegisterMail($this->mail_content));
        }
    }
}
