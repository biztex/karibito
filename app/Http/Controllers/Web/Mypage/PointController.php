<?php

namespace App\Http\Controllers\Web\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserCoupon;
use App\Models\UserGetPoint;
use App\Models\UserUsePoint;
use App\Services\PointService;

class PointController extends Controller
{
    private $point_service;

    public function __construct(PointService $point_service)
    {
        $this->point_service = $point_service;
    }

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
        ])
            ->get();
        $user_use_points = UserUsePoint::where([
            ['user_id', '=', \Auth::id()],
            ['deleted_at', '=', null],
        ])
            ->get();
        $user_has_point = $this->point_service->showPoint();

        return view('mypage.point.index', compact('user_has_point', 'user_get_points', 'user_use_points'));
    }
}
