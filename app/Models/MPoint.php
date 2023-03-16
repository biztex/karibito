<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPoint extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    // const NEW_REGISTRATION = 1;
    // const FIRST_EXHIBITION = 2;
    // 注意、仕様を変えられる可能性がある
    const TRANSACTION_COMPLETED = 1;
    const PRODUCT_REGISTRATION = 2;
    const INVITED_FRIEND = 3;
    const PERSONAL_AUTHENTICATION = 4;

    const POINT_NAME = [
        self::TRANSACTION_COMPLETED => '取引完了時付与ポイント',
        self::PRODUCT_REGISTRATION => '出品登録時付与ポイント',
        self::INVITED_FRIEND => '友達招待時(新規登録コード入力時)付与ポイント',
        self::PERSONAL_AUTHENTICATION => '本人認証時付与ポイント'
    ];
}
