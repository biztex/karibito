<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KaribitoSurvey;

class KaribitoSurveyController extends Controller
{
    public function index()
   {
        $karibito_survey = KaribitoSurvey::orderBy('updated_at','desc')->paginate(50);
        
        return view('admin.survey.index',compact('karibito_survey'));
   }
}
