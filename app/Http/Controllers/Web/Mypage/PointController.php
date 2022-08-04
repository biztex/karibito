<?php

namespace App\Http\Controllers\Web\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserCoupon;

class PointController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        // $user_coupons = UserCoupon::where([
        //     ['user_id', '=', \Auth::id()],
        //     ['used_at', '=', null],
        // ])
        // ->get();

        // return view('mypage.coupon.index', compact('user_coupons'));
        return view('mypage.point.index');
    }
}
