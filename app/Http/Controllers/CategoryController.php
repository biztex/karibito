<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * カテゴリー追加依頼表示する
     * 
     * @return view
     */
    public function add()
    {
        return view('sample.add_category');
    }
}
