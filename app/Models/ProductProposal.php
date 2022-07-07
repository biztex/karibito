<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProposal extends Model
{
    use HasFactory;

    const NOT_PURCHESE = 0;
    
    const IS_PURCHESE = 1;

    const PURCHESE_STATUS = [
        self::NOT_PURCHESE => '未購入',
        self::IS_PURCHESE => '購入',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function productChatroomMessage()
    {
        return $this->morphOne(ProductChatroomMessage::class, 'reference');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productChatroom()
    {
        return $this->belongsTo(ProductChatroom::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
