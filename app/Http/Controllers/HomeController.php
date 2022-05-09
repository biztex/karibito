<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * カテゴリー追加依頼表示する
     * 
     * @return view
     */
    public function addCategory()
    {
        return view('sample.add_category');
    }
}
