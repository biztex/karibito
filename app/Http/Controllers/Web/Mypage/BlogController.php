<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mypage.blog.create');
    }
}
