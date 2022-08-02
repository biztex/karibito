<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const GOOD = 5;

    const USUALLY = 2.5;
    
    const PITY = 1;

    // 対象ユーザーの評価のみ取得
    public function scopeTargetUser($query, $user_id)
    {
        return $query->where('target_user_id',$user_id);
    }

     // 対象ユーザーの「よかった」の評価のみ取得
     public function scopeGoodStar($query, $user_id)
     {
         return $query->targetUser($user_id)->where('star',self::GOOD);
     }

     // 対象ユーザーの「普通」の評価のみ取得
     public function scopeUsuallyStar($query, $user_id)
     {
         return $query->targetUser($user_id)->where('star',self::USUALLY);
     }

     // 対象ユーザーの「残念」の評価のみ取得
     public function scopePityStar($query, $user_id)
     {
         return $query->targetUser($user_id)->where('star',self::PITY);
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}
