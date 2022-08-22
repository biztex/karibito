<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMailHistory extends Model
{
    use HasFactory;

    // タイプを非表示に変更したので　コメントアウト
    // public const TYPE_ZERO= 0; //仮名
    // public const TYPE_ONE = 1; //仮名
    // public const TYPE_TWO = 2; //仮名

    // public const CONTACT_TYPES = [
    //     self::TYPE_ZERO => 'お問い合わせ種別',
    //     self::TYPE_ONE => 'お問い合わせ種別1',
    //     self::TYPE_TWO => 'お問い合わせ種別2'
    // ];

    protected $guarded = ['id'];
}
