<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * 掲載一覧画面を表示する
     * 
     * @return view
     */
    public function index()
    {
        return view('sample.publication');
    }
}
