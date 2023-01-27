<?php

namespace App\Services;

use App\Models\Chatroom;
use App\Models\JobRequest;
use App\Models\MCoupon;
use App\Models\UserGetPoint;
use App\Models\UserCoupon;
use App\Models\MPointRate;
use App\Models\Product;
use App\Models\Proposal;
use Carbon\Carbon;


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

        if($coupon_number === null){
            return null;
        }

        $used_coupon = UserCoupon::where([
            ['user_id', '=', \Auth::id()],
            ['used_at', '=', null],
            ['coupon_number', '=', $coupon_number],
        ])->first();

        $used_coupon->used_at = Carbon::now();
        $used_coupon->save();

        return $used_coupon;
    }

    public function cancelCoupon($user_coupon)
    {
        if($user_coupon === null){
            return null;
        }

        $user_coupon->used_at = null;
        $user_coupon->save();
    }

    /**
     * ユーザーへのクーポン付与
     *
     * @param int $coupon_id
     * @param int $user_id
     * @return void
     */
    public function createUserCoupon(int $coupon_id, int $user_id): void
    {
        $m_coupon = MCoupon::where('id', $coupon_id)->first();
        $coupon_number = str_pad(random_int(0,99999999), 9, 0, STR_PAD_LEFT);
        $deadline = date("Y-m-d", mktime(0, 0, 0, date("m") + $m_coupon->deadline_period, date("d"), date("Y")));
        UserCoupon::create([
            'user_id' => $user_id,
            'coupon_number' => $coupon_number,
            'name' => $m_coupon->name,
            'content' => $m_coupon->content,
            'deadline' => $deadline,
            'discount' => $m_coupon->discount,
            'min_price' => $m_coupon->min_price
        ]);
    }
}
