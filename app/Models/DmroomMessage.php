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
    public function dmrooms()
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
    
    // 送信者を取得する
    public static function getSendUser($dmroom){
        $send_message = DmroomMessage::with('user')->where('dmroom_id',$dmroom->id)
        ->latest()
        ->first();
        $send_user = $send_message->user;
        return $send_user;
    }
    
    // 受信者を取得する
    public static function getReceiveUser($dmroom){
        $send_message = DmroomMessage::with('user')->where('dmroom_id',$dmroom->id)
        ->latest()
        ->first();
        
        $send_user = $send_message->user;
        if($dmroom->from_user_id !== $send_user->id){
            $receive_user_id = $dmroom->from_user_id;
        }else{
            $receive_user_id = $dmroom->to_user_id;
        }
        
        $receive_user = User::where('id',$receive_user_id)->firstOrFail();
        return $receive_user;
    }
}
