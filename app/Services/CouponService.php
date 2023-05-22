<?php

namespace App\Services;

use App\Jobs\SendNewCouponNotificationMail;
use App\Models\Chatroom;
use App\Models\JobRequest;
use App\Models\MCoupon;
use App\Models\User;
use App\Models\UserGetPoint;
use App\Models\UserCoupon;
use App\Models\MPointRate;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\UserNotification;
use Carbon\Carbon;


class CouponService
{
    public function showCoupon()
    {
        $user_coupons = UserCoupon::where([
            ['user_id', \Auth::id()],
            ['used_at', null],
            ['deadline', '>=', Carbon::today()->format('Y-m-d')],
        ])
        ->get();
        return $user_coupons;
    }

    public function getCouponDiscount($coupon_id)
    {
        $discount = UserCoupon::where([
            ['user_id', \Auth::id()],
            ['used_at', null],
            ['id', $coupon_id],
        ])
        ->pluck('discount')->first();
        return $discount;
    }

    public function usedCoupon($coupon_id)
    {

        if($coupon_id === null){
            return null;
        }

        $used_coupon = UserCoupon::where([
            ['user_id', \Auth::id()],
            ['used_at', null],
            ['id', $coupon_id],
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

        $user = User::findOrFail($user_id);

        $user_notification = [
            'user_id' => $user_id,
            'title' => 'クーポンを取得しました。',
            'reference_type' => 'App\Models\MCoupon',
            'reference_id' => $user->id,
        ];

        if(empty($user->userNotificationSetting->is_news)) {
            $user_notification['is_notification'] = 0;
        } else {
            $user_notification['is_notification'] = 1;
        }

        $mail_content = UserNotification::create($user_notification);
        SendNewCouponNotificationMail::dispatch($mail_content);
    }
}
