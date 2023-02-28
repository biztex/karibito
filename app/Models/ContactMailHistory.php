<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMailHistory extends Model
{
    use HasFactory;

    public const INFO = 0;
    public const SERVICE = 1;
    public const SELL_BUY = 2;
    public const CANCEL = 3;
    public const TROUBLE = 4;
    public const REPORT = 5;
    public const OTHER = 6;
    public const CATEGORY = 7;

    public const CONTACT_TYPES = [
        self::INFO => '【会員情報に関して】',
        self::SERVICE => '【サービスに関して】',
        self::SELL_BUY => '【購入・支払いに関して】',
        self::CANCEL => '【キャンセル・返金に関して】',
        self::TROUBLE => '【トラブルに関して】',
        self::REPORT => '【ご通報】',
        self::CATEGORY => '【カテゴリー項目追加依頼】',
        self::OTHER => '【その他】',
    ];

    protected $guarded = ['id'];
}
