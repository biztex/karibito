<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\TextFormat;


class UserNotification extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // メッセージはリンク生成する
    public function getContentAttribute($value)
    {
        $textFormat = new TextFormat();
        if ($value === null) {
            return null;
        } else {
            return $textFormat->generateLinkFromSentence($value);
        }
    }
}
