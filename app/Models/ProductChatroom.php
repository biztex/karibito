<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductChatroom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
    public function product()
    {
        return $this->belongsTo(Product::class);
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
    public function productChatroomMessage()
    {
        return $this->hasMany(ProductChatroomMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productProposal()
    {
        return $this->hasMany(ProductProposal::class);
    }    
}
