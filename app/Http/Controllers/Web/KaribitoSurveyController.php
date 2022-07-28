<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\KaribitoSurvey;
use Illuminate\Http\Request;

class KaribitoSurveyController extends Controller
{
    public function create()
    {
        return view('survey.karibito_survey');
    }

    public function store(Request $request)
    {
        $columns = ['star', 'comment'];

        $survey = new KaribitoSurvey();
        $survey->user_id = \Auth::id();
        foreach($columns as $column){
            $survey->$column = $request[$column];
        }
        $survey->save();
        
        return redirect()->route('mypage');
    }
}