<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\KaribitoSurvey;
use App\Models\Chatroom;
use Illuminate\Http\Request;
use App\Http\Requests\SurveyController\StoreRequest;
use App\Services\KaribitoSurveyService;

class KaribitoSurveyController extends Controller
{
    private $karibito_survey_service;

    public function __construct(KaribitoSurveyService $karibito_survey_service)
    {
        $this->karibito_survey_service = $karibito_survey_service;
    }

    public function create(Chatroom $chatroom)
    {
        return view('survey.karibito_survey',compact('chatroom'));
    }

    public function store(StoreRequest $request, Chatroom $chatroom)
    {
        $karibito_survey_service = $this->karibito_survey_service->storeSurvey($request->all());

        return redirect()->route('chatroom.show', $chatroom->id)->with('flash_msg','アンケートに回答しました！');
    }
}