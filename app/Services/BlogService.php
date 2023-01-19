<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\BlogImage;
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
        // 対象html
        $content = $request->input('content');
        // htmlに含まれる画像パスの検索
        preg_match_all('/<img.*?src\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i', $content, $img_path_list);

        DB::transaction(function () use ($request, $img_path_list) {
            // ブログ情報登録
            $blog = new Blog();
            $blog->user_id = Auth::id();
            $blog->path = $img_path_list[1] ? $img_path_list[1][0] : 'OGP.jpg';
            $blog->fill($request->substitutable());
            $blog->save();
            // ブログ内に画像が投稿されていれば登録
            if ($img_path_list) {
                BlogImage::whereIn('url', $img_path_list[1])->update([
                    'blog_id' => $blog->id
                ]);
            }
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
        // 対象html
        $content = $request->input('content');
        // htmlに含まれる画像パスの検索
        preg_match_all('/<img.*?src\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i', $content, $img_path_list);

        DB::transaction(function () use ($request, $blog, $img_path_list) {
            $blog->fill($request->substitutable());
            $blog->save();
            // ブログ内に画像が投稿されていれば登録
            if ($img_path_list) {
                BlogImage::whereIn('url', $img_path_list[1])->update([
                    'blog_id' => $blog->id
                ]);
            }
        });
    }

    /**
     * ブログ削除
     * 
     * @param Blog $blog
     * @return void
     */
    public function deleteBlog(Blog $blog): void
    {
        DB::transaction(function () use ($blog) {
            $blog->blogImage->isEmpty() ? : $blog->blogImage()->delete();
            $blog->delete();
        });
    }
}
