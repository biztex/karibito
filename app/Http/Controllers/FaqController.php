<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{

    /**
     * 質問回答画面を表示する
     * 
     * @return view
     */
    public function indexAnswer()
    {
        return view('sample.faq_answer');
    }

    /**
     * 質問詳細画面を表示する
     * 
     * @return view
     */
    public function indexDetail()
    {
        return view('sample.faq_detail');
    }

    /**
     * 質問投稿画面を表示する
     * 
     * @return view
     */
    public function createPost()
    {
        return view('sample.faq_post');
    }

    /**
     * 知恵袋一覧画面を表示する
     * 
     * @return view
     */
    public function index()
    {
        return view('sample.faq');
    }
}
