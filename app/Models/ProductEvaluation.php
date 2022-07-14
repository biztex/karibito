<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEvaluation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const GOOD = 5;

    const USUALLY = 2.5;
    
    const PITY = 1;


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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function targetUser()
    {
        return $this->belongsTo(User::class);
    }
}
