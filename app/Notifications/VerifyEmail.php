<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \Illuminate\Support\Carbon;

class VerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public static $toMailCallback;

    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * 
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * 
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);
 
        if (static::$toMailCallback) {
            return \call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return (new MailMessage())
            ->subject(\Lang::get('【カリビト】メールアドレス確認'))
            ->line(\Lang::get('この度はカリビトにご登録いただきありがとうございます。'))
            ->line(\Lang::get('本メールはご登録いただいたメールアドレスが正しいかどうか確認するための認証用のメールです。'))
            ->line(\Lang::get('メールアドレス認証を完了するには以下のボタンをクリックしてください。'))
            ->action(\Lang::get('メールアドレスを認証'),$verificationUrl)
            ->line(\Lang::get('このメールにお心当たりがない場合は、お手数をおかけしますがこのメールは破棄してください。'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param mixed $notifiable
     * 
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return \URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(\Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param \Closure $callback
     * 
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @param mixed $notifiable
    //  * 
    //  * @return array
    //  */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
}
