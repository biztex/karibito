<?php

namespace App\Services;

use App\Models\Chatroom;
use App\Models\JobRequest;
use App\Models\MPoint;
use App\Models\UserGetPoint;
use App\Models\MPointRate;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\UserProfile;
use App\Models\UserUsePoint;
use App\Traits\UserHasPointTrait;
use Illuminate\Database\Eloquent\Model;

class PointService
{
    use UserHasPointTrait;
    
    public function showPoint()
    {
        return $this->userHasPoint();
    }

    public function getPoint(int $point_id, Model $instance)
    {
        $m_point = MPoint::where('id', $point_id)->first();
        // $point_rate = MPointRate::where('effective_datetime', '<=', $today)->latest()->first(); 仕様が変わる可能性があるため一旦残す
        // $now_rate = $point_rate->rate;
        
        $deadline = date("Y-m-d",mktime(0, 0, 0, date("m")+$m_point->deadline_period, date("d"), date("Y")));
        $user_get_point = new UserGetPoint();
        $user_get_point->create([
            'user_id' => $instance->user_id,
            'name' => $m_point->name,
            'point' => $m_point->point,
            'deadline' => $deadline,
            'reference_type' => get_class($instance),
            'reference_id' => $instance->id,
        ]);
    }

    public function usedPoint(Chatroom $chatroom, int|null $point)
    {
        if($point === null){
            return null;
        }

        $service_title = $chatroom->reference->title;

        $user_use_point = UserUsePoint::create([
            'user_id' => \Auth::id(),
            'name' => $service_title, //購入したサービスのタイトルが入るようになっている。要確認
            'point' => $point,
        ]);

        return $user_use_point;
    }

    public function cancelPoint(UserUsePoint|null $user_use_point)
    {

        if($user_use_point === null){
            return null;
        }
        $user_use_point->delete();
    }
}
