<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    const Coupon_list = [
        '事前会員登録500円OFFクーポン' => [
            'price' => 500,
            'contents' => [
                '＊5,000円以上のお支払いでご利用いただけます',
                '＊お1人様1回限り使用可能です',
                '＊ポイント、他のクーポンとの併用はできません'
            ]
        ],
        '新規会員登録500円OFFクーポン' => [
            'price' => 500,
            'contents' => [
                '＊5,000円以上のお支払いでご利用いただけます',
                '＊お1人様1回限り使用可能です',
                '＊ポイント、他のクーポンとの併用はできません'
            ]
        ],
        'カリビトアンケート回答100円OFFクーポン' => [
            'price' => 100,
            'contents' => [
                '＊1,000円以上のお支払いでご利用いただけます',
                '＊お1人様1回限り使用可能です',
                '＊ポイント、他のクーポンとの併用はできません'
            ]
        ],
    ];
}
