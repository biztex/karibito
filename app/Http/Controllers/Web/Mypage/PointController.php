<?php

namespace App\Http\Controllers\Web\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserCoupon;
use App\Models\UserGetPoint;

class PointController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $today = date('Y-m-d');
        $user_get_points = UserGetPoint::where([
            ['user_id', '=', \Auth::id()],
            ['deadline', '>=', $today],
        ])
        ->get();

        return view('mypage.point.index', compact('user_get_points'));
    }
}
