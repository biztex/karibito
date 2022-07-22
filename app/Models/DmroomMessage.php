<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\TextFormatService;

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
