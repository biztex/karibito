<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\TextFormat;

class DmroomMessage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dmroom()
    {
        return $this->belongsTo(Dmroom::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
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
    
    // 受信者を取得する
    public function getReceiveUser($dmroom_message)
    {
        $send_user = $dmroom_message->user;
        $dmroom = $dmroom_message->dmroom;
        if($dmroom->from_user_id !== $send_user->id){
            $receive_user = $dmroom->fromUser;
        }else{
            $receive_user = $dmroom->toUser;
        }

        return $receive_user;
    }
}
