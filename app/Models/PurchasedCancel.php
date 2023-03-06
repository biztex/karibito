<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedCancel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS_APPLYING = 1;
    const STATUS_CANCELED = 2;
    const STATUS_OBJECTION = 3;
    const STATUS = [
        self::STATUS_APPLYING => '申請中',
        self::STATUS_CANCELED => '成立',
        self::STATUS_OBJECTION => '異議申し立て'
    ];

    const REASON = [
        1 => '誤って重複購入してしまった',
        2 => '相手と連絡がつかない',
        3 => '購入者の都合で取引が継続できなくなった',
        4 => '出品者の都合で提供できなくなった',
        5 => 'スケジュールの折り合いがつかなくなった',
        6 => 'その他トラブル'
    ]; 

    /**
     * キャンセル数取得
     *
     * @param int $user_id
     * @return int
     */
    public function getCancelCount(int $user_id): int
    {
        return $this->whereHas('purchase.chatroom', function ($chatroom) use ($user_id) {
            $chatroom->where('seller_user_id', $user_id)
                ->orWhere('buyer_user_id', $user_id);
        })->whereNotNull('cancel_date')->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function chatroomMessage()
    {
        return $this->morphOne(ChatroomMessage::class, 'reference');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
