<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     * @return void
     */
    public static $toMailCallback;

    public static $createUrlCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
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
        if (static::$toMailCallback) {
            return \call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        if (static::$createUrlCallback) {
            $url = \call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        } else {
            $url = url(route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
        }

        return $this->buildMailMessage($url);

    }

    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param string $url
     * 
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage())
            ->subject(\Lang::get('【カリビト】パスワード再設定'))
            ->line(\Lang::get('パスワード再設定のリクエストを受け付けいたしました。'))
            ->action(\Lang::get('パスワード再設定'), $url)
            ->line(\Lang::get('このリンクの有効期限は :count 分です。', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
            ->line(\Lang::get('このメールにお心当たりがない場合は、お手数をおかけしますがこのメールは破棄してください。'));
    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @param mixed $notifiable
    //
    //  * @return array
    //  */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
}
