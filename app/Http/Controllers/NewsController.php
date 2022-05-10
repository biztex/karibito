<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * お知らせ一覧画面を表示する
     * 
     * @return view
     */
    public function indexNews()
    {
        return view('sample.news');
    }

      /**
     * お知らせ詳細画面を表示する
     * 
     * @return view
     */
    public function showDetail()
    {
        return view('sample.news_detail');
    }
}
