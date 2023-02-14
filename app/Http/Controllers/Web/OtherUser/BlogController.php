<?php

namespace App\Http\Controllers\Web\OtherUser;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\MProductCategory;
use App\Models\MProductChildCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    /**
     * 親カテゴリに一致するブログ一覧
     *
     * @param MProductCategory $category
     * @return View|Factory
     */
    public function index(MProductCategory $category)
    {
        $child_categories_id = MProductChildCategory::where('parent_category_id', $category->id)->pluck('id')->toArray();
        // 選択カテゴリに一致するサービスを含むブログ一覧の取得
        $blogs = Blog::publish()->whereHas('product', function ($product) use ($child_categories_id){
            $product->whereIn('category_id', $child_categories_id);
        })->paginate(10);
        $m_product_categories = MProductCategory::all();
        $child_categories = $category->mProductChildCategory;
        $parent_category_flg = 1;
        $title = $category->name;

        return view('blog.index', compact('category', 'child_categories', 'parent_category_flg', 'title', 'blogs', 'm_product_categories'));
    }

    /**
     * 子カテゴリに一致するブログ一覧の取得(親カテゴリ一覧詳細)
     *
     * @param MProductChildCategory $child_category
     * @return View|Factory
     */
    public function show(MProductChildCategory $child_category)
    {
        // 選択カテゴリに一致するサービスを含むブログ一覧の取得
        $blogs = Blog::publish()->whereHas('product', function ($product) use ($child_category){
            $product->where('category_id', $child_category->id);
        })->paginate(10);
        $m_product_categories = MProductCategory::all();
        $all_child_categories = $child_category->mProductCategory->mProductChildCategory;
        $child_category_id = $child_category->id;
        $parent_category_flg = 0;
        $title = $child_category->mProductCategory->name;
        $category = $child_category->mProductCategory;

        return view('blog.index', compact('all_child_categories', 'child_category', 'child_category_id', 'parent_category_flg', 'title', 'blogs', 'm_product_categories'));
    }
}
