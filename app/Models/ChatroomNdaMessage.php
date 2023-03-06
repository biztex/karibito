<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatroomNdaMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    const CONFIRMING_RECEIVED_USER = 1; // 受信者確認中
    const CONFIRMING_USER_SUBMITTED = 2; // 送信者確認中
    const CONCLUSION = 3; // 締結

    /**
     * ユーザー
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * チャットルーム
     *
     * @return BelongsTo
     */
    public function chatroom(): BelongsTo
    {
        return $this->belongsTo(Chatroom::class);
    }

    /**
     * チャットルームメッセージ
     * 
     * @return MorphOne
     */
    public function chatroomMessage(): MorphOne
    {
        return $this->morphOne(ChatroomMessage::class, 'reference');
    }
}
