<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * トップ画面を表示する
     * 
     * @return view
     */
    public function index()
    {
        return view('sample.index');
    }
}
