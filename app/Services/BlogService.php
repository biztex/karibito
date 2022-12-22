<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogService
{
    /**
     * ブログ一覧取得
     *
     * @return Collection
     */
    public function getBlogs(): Collection
    {
        return Blog::where('user_id', Auth::id())->get();
    }

    /**
     * ブログ登録
     * 
     * @param Request $request
     * @return void
     */
    public function storeBlog(Request $request): void
    {
        DB::transaction(function () use ($request) {
            $blog = new Blog();
            $blog->user_id = Auth::id();
            // 画像パスは一旦静的に指定。仕様が決定次第要修正
            $blog->path = 'OGP.jpg';
            $blog->fill($request->substitutable());
            $blog->save();
        });
    }

    /**
     * ブログ更新
     * 
     * @param Request $request
     * @param Blog $blog
     * @return void
     */
    public function updateBlog(Request $request, Blog $blog): void
    {
        DB::transaction(function () use ($request, $blog) {
            $blog->fill($request->substitutable());
            $blog->save();
        });
    }

    /**
     * ブログ削除
     * 
     * @param Blog $blog
     * @return void
     */
    public function deleteBlog(Blog $blog)
    {
        DB::transaction(function () use ($blog) {
            $blog->delete();
        });
    }
}
