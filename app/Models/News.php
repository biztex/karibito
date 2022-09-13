<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\TextFormat;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    // const STATUS_PRIVATE = 0;
    // const STATUS_PUBLISH = 1;

    // const PUBLIC_STATUS = [
    //     self::STATUS_PRIVATE => '非公開',
    //     self::STATUS_PUBLISH => '公開',
    // ];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function userNotifications()
    {
        return $this->morphMany(UserNotification::class, 'reference');
    }
}
