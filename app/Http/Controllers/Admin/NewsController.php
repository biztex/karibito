<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\StoreRequest;
use App\Models\News;
use App\Services\NewsService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    private $news_service;

    public function __construct(NewsService $news_service)
    {
        $this->news_service = $news_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news_list = $this->news_service->paginate(5);

        return view('admin.news.index', compact('news_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->news_service->storeNews($request->all());
        $this->news_service->storeUserNotification($request->all());

        return redirect()->route('admin.news.index')->with('flash_msg', 'ニュースを投稿しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, News $news)
    {
        $this->news_service->updateNews($request->all(), $news);

        return redirect()->route('admin.news.index')->with('flash_msg', 'ニュースを編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete(); // データ論理削除

        return redirect()->route('admin.news.index')->with('flash_msg', 'ニュースを削除しました');
    }
}
