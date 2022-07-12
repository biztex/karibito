<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    private $news_service;

    public function __construct(NewsService $news_service)
    {
        $this->news_service = $news_service;
    }

    public function index()
    {
        $news_list = $this->news_service->paginate(20);

        return view('news.index', compact('news_list'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }
}
