<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogController\StoreRequest;
use App\Http\Requests\BlogController\UpdateRequest;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * @var BlogService
     */
    private $blog_service;

    /**
     * @param BlogService $blog_service
     */
    public function __construct(BlogService $blog_service)
    {
        $this->blog_service = $blog_service;
    }

    /**
     * ブログ一覧
     *
     * @return View
     */
    public function index(): View
    {
        $blogs = $this->blog_service->getBlogs();
        return view('mypage.blog.index', compact('blogs'));
    }

    /**
     * ブログ作成画面表示
     *
     * @return View
     */
    public function create(): View
    {
        return view('mypage.blog.create');
    }

    /**
     * ブログ登録
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->blog_service->storeBlog($request);
        return redirect()->route('blog.index')->with('flash_msg', 'ブログを投稿しました！');
    }

    /**
     * ブログ詳細画面表示
     *
     * @param Blog $blog
     * @return View
     */
    public function show(Blog $blog): View
    {
        return view('mypage.blog.show', compact('blog'));
    }

    /**
     * ブログ編集画面表示
     *
     * @param Blog $blog
     * @return View
     */
    public function edit(Blog $blog): View
    {
        return view('mypage.blog.edit', compact('blog'));
    }

    /**
     * ブログ更新
     *
     * @param UpdateRequest $request
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Blog $blog): RedirectResponse
    {
        $this->blog_service->updateBlog($request, $blog);
        return redirect()->route('blog.index')->with('flash_msg', 'ブログを更新しました！');
    }

    /**
     * ブログ削除
     *
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        $this->blog_service->deleteBlog($blog);
        return redirect()->route('blog.index')->with('flash_msg', 'ブログを削除しました！');
    }
}
