<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * ポイント履歴画面を表示する
     * 
     * @return view
     */
    public function index()
    {
        return view('sample.point_history');
    }
}
