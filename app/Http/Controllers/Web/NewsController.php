<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news_list = News::orderBy('created_at','desc')->paginate(5);
        return view('news.index', compact('news_list'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }
}
