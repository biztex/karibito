<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function jobRequest()
    {
        return $this->hasMany(JobRequest::class);
    }

    /**
     * Override Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    /**
     * Override to send for password reset notification.
     *
     * @param [type] $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    /**
     * ユーザーが削除された（退会した）際に紐づくデータも削除
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($user) {
            $user->userProfile()->delete(); // プロフィール削除
            $user->jobRequest()->delete(); // ジョブリクエスト削除
        });
    }
}
