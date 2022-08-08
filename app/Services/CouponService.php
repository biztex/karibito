<?php

namespace App\Services;

use App\Models\Chatroom;
use App\Models\JobRequest;
use App\Models\UserGetPoint;
use App\Models\UserCoupon;
use App\Models\MPointRate;
use App\Models\Product;
use App\Models\Proposal;
use App\Traits\UserHasPointTrait;

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
}
