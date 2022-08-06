<?php

namespace App\Services;

use App\Models\Chatroom;
use App\Models\JobRequest;
use App\Models\UserGetPoint;
use App\Models\MPointRate;
use App\Models\Product;
use App\Models\Proposal;
use App\Traits\UserHasPointTrait;

class PointService
{
    use UserHasPointTrait;

    public function showPoint()
    {
        return $user_has_point = $this->userHasPoint();
    }

    public function getPoint(Chatroom $chatroom, int $amount)
    {
        $today = date('Y-m-d');
        $point_rate = MPointRate::where('effective_datetime', '<=', $today)->latest()->first();
        $now_rate = $point_rate->rate;
        $deadline = date("Y-m-d",mktime(0, 0, 0, date("m")+6, date("d"), date("Y"))); //有効期限はもらってから半年後に設定(仮)
        $point = ($amount * $now_rate) / 100;
        $service = $chatroom->reference;
        $get_point = [
            'user_id' => \Auth::id(),
            'name' => $service->title,
            'point' => $point,
            'deadline' => $deadline,
        ];
        $service->points()->create($get_point);
    }
}
