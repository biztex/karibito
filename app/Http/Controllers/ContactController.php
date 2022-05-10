<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * コンタクト画面を表示する
     * 
     * @return view
     */
    public function contact()
    {
        return view('sample.contact');
    }

    /**
     * 下書き一覧画面を表示する
     * 
     * @return view
     */
    public function indexDraft()
    {
        return view('sample.draft');
    }
}
