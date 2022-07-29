<?php

namespace App\Services;

use App\Models\KaribitoSurvey;
use App\Models\Chatroom;

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
        ];

        $survey = $chatroom->reference->karibitoSurvey()->create($columns);

        return $survey;
    }
}