<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequestChatroom extends Model
{
    use HasFactory;

    const STATUS = [
        1 => 'チャット開始',
        2 => '契約',
        3 => '作業',
        4 => '評価',
        5 => '完了',
        6 => 'キャンセル'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobRequest()
    {
        return $this->belongsTo(JobRequest::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function sellerUser()
    {
        return $this->belongsTo(User::class, 'seller_user_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function buyerUser()
    {
        return $this->belongsTo(User::class, 'buyer_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatroomMessage()
    {
        return $this->hasMany(JobRequestChatroomMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposal()
    {
        return $this->hasMany(JobRequestProposal::class);
    }  
}
