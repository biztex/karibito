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


    protected $appends = ['avg_star'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
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
     * @param string $token
     *
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
            $user->userProfile->delete(); // プロフィール削除
        });
    }

    public function getAvgStarAttribute()
    {
        return $this->attributes['avg_star'] = $this->evaluations->avg('star');
    }

    /**
     * 通知設定
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userNotificationSetting()
    {
        return $this->hasOne(UserNotificationSetting::class);
    }

    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }

    public function userCareers()
    {
        return $this->hasMany(UserCareer::class);
    }

    public function userJob()
    {
        return $this->hasMany(UserJob::class);
    }
    
    public function dmroom()
    {
        return $this->hasMany(Dmroom::class);
    }

    public function specialty()
    {
        return $this->hasMany(Specialty::class);
    }
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'target_user_id');
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}