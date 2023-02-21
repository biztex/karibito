<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    const COMMISSION = -200;
    const STATUS_NONE = 1;
    const STATUS_REQUESTING = 2;
    const STATUS_COMPLETE = 3;

    const STATUS = [
        self::STATUS_NONE => '未申請 / 失敗',
        self::STATUS_REQUESTING => '申請中',
        self::STATUS_COMPLETE => '振込済'
    ];

    public function scopeFailed($query, int $user_id)
    {
        return $query->notTransfer($user_id)->whereAmount(self::COMMISSION);
    }

    /**
     * 振込未申請の売上取得
     */
    public function scopeNotTransfer($query, int $user_id)
    {
        return $query->whereStatus(1)
            ->whereUserId($user_id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatroom()
    {
        return $this->belongsTo(Chatroom::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transferRequests()
    {
        return $this->hasMany(TransferRequest::class);
    }
}
