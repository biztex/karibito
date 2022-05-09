<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * 個人情報の取り扱いについて画面を表示する
     * 
     * @return view
     */
    public function show()
    {
        return view('sample.privacy');
    }
}
