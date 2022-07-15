<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\TextFormatService;

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
        $textFormatService = new TextFormatService();
        if ($value === null) {
            return null;
        } else {
            return $textFormatService->generateLinkFromSentence($value);
        }
    }
}
