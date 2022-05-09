<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstimateController extends Controller
{
    /**
     * 見積書画面を表示する
     * 
     * @return view
     */
    public function index()
    {
        return view('sample.estimate');
    }
}
