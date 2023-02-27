<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\UserCoupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $today = Carbon::today();
        $user_coupons = UserCoupon::where([
            ['user_id', '=', \Auth::id()],
            ['used_at', '=', null],
        ])
        ->whereDate('deadline', '>=', $today)
        ->get();

        return view('mypage.coupon.index', compact('user_coupons'));
    }
}
