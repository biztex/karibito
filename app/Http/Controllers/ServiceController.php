<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * サービス一覧画面を表示する
     * 
     * @return view
     */
    public function indexService()
    {
        return view('sample.service');
    }

    /**
     * サービス詳細画面を表示する
     * 
     * @return view
     */
    public function showService()
    {
        return view('sample.service_detail');
    }
}
