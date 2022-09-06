<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\TextFormat;

class ChatroomMessage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const NOT_COMPLETE = 0;
    
    const IS_COMPLETE = 1;

    const IS_COMPLETE_MESSAGE = [
        self::NOT_COMPLETE => '購入未完了',
        self::IS_COMPLETE => '購入完了',
    ];

    protected $appends = ['to_user_id'];

    protected function getToUserIdAttribute()
    {
        if($this->chatroom->sellerUser->id == $this->user_id)
        {
            return $this->chatroom->buyer_user_id;
        } else {
            return $this->chatroom->seller_user_id;
        }
    }

    public function scopeWorked($query)
    {
        return $query->where('is_complete_message', 1)->exists();
    }

    public function scopePartner($query)
    {
        return $query->where('user_id', '<>', \Auth::id());
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reference()
    {
        return $this->morphTo(__FUNCTION__, 'reference_type', 'reference_id');
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

    // メッセージはリンク生成する
    public function getTextAttribute($value)
    {
        $textFormat = new TextFormat();
        if ($value === null) {
            return null;
        } else {
            return $textFormat->generateLinkFromSentence($value);
        }
    }
}
