<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequestChatroom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    const STATUS = [
        1 => 'チャット開始',
        2 => '契約',
        3 => '作業',
        4 => '購入者評価',
        5 => '出品者評価',
        6 => '完了',
        7 => 'キャンセル'
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
    public function jobRequestChatroomMessage()
    {
        return $this->hasMany(JobRequestChatroomMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobRequestProposal()
    {
        return $this->hasMany(JobRequestProposal::class);
    }  
}
