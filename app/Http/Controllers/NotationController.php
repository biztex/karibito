<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotationController extends Controller
{
    /**
     * 特定商取引法に基づく表記画面を表示する
     * 
     * @return view
     */
    public function show()
    {
        return view('sample.notation');
    }
}
