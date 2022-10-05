<?php

namespace App\Services;

use App\Models\Chatroom;
use App\Models\JobRequest;
use App\Models\UserGetPoint;
use App\Models\UserCoupon;
use App\Models\MPointRate;
use App\Models\Product;
use App\Models\Proposal;

class CouponService
{
    public function showCoupon()
    {
        $user_coupons = UserCoupon::where([
            ['user_id', '=', \Auth::id()],
            ['used_at', '=', null],
        ])
        ->get();
        return $user_coupons;
    }

    public function getCouponDiscount($coupon_number)
    {
        $discount = UserCoupon::where([
            ['user_id', '=', \Auth::id()],
            ['used_at', '=', null],
            ['coupon_number', '=', $coupon_number],
        ])
        ->pluck('discount')->first();
        return $discount;
    }

    public function usedCoupon($coupon_number)
    {
        $used_coupon = UserCoupon::where([
            ['user_id', '=', \Auth::id()],
            ['used_at', '=', null],
            ['coupon_number', '=', $coupon_number],
        ])
        ->first();
// used_atを入れる
        dd($used_coupon);
        return $discount;
    }
}
