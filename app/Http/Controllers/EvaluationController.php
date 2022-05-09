<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * 評価一覧画面を表示する
     * 
     * @return view
     */
    public function index()
    {
        return view('sample.evaluation');
    }
}
