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
        $coupon = MCoupon::where('id', MCoupon::QUESTIONNAIRE_ANSWER)->first();
        $coupon_number = str_pad(random_int(0,99999999),9,0, STR_PAD_LEFT);
        $deadline_period = date("Y-m-d",mktime(0, 0, 0, date("m")+$coupon->deadline_period, date("d"), date("Y"))); //マスターで設定した数字ヶ月後になる

        $user_coupon->create([
            'user_id' => \Auth::id(),
            'coupon_number' => $coupon_number,
            'name' => $coupon->name,
            'content' => $coupon->content,
            'deadline' => $deadline_period,
            'discount' => $coupon->discount,
            'min_price' => $coupon->min_price,
        ]);

        return $survey;
    }
}