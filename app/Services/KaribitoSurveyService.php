<?php

namespace App\Services;

use App\Models\KaribitoSurvey;
use App\Models\Chatroom;
use App\Models\MCoupon;
use App\Models\UserCoupon;

class KaribitoSurveyService
{
    /**
     *  アンケートを登録
     */
    public function storeSurvey(array $params, Chatroom $chatroom):KaribitoSurvey
    {
        $columns = [
            'user_id' => \Auth::id(),
            'star' => $params['star'],
            'comment' => $params['comment'],
            'chatroom_id' => $params['chatroom_id'],
        ];

        $survey = $chatroom->reference->karibitoSurvey()->create($columns);

        $user_coupon = new UserCoupon();
        $coupon = MCoupon::where('id', '1')->first();
        $coupon_number = str_pad(random_int(0,99999999),9,0, STR_PAD_LEFT);

        $user_coupon->create([
            'user_id' => \Auth::id(),
            'coupon_number' => $coupon_number,
            'name' => $coupon->name,
            'content' => $coupon->content,
            'deadline' => $coupon->deadline_period, //修正する
            'discount' => $coupon->discount,
            'min_price' => $coupon->min_price,
        ]);

        return $survey;
    }
}