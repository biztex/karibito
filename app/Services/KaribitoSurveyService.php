<?php

namespace App\Services;

use App\Models\KaribitoSurvey;

class KaribitoSurveyService
{
    /**
     *  アンケートを登録
     */
    public function storeSurvey(array $params):KaribitoSurvey
    {
        $columns = ['star', 'comment'];

        $survey = new KaribitoSurvey();
        $survey->user_id = \Auth::id();
        foreach($columns as $column){
            $survey->$column = $params[$column];
        }
        $survey->save();

        return $survey;
    }
}