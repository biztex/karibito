<?php

namespace App\Http\Controllers\Web\OtherUser;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\MProductCategory;
use App\Models\MProductChildCategory;

class ProductController extends Controller
{

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(MProductCategory $category)
    {
        $products = Product::publish()->where('category_id',$category->id)->orderBy('created_at','desc')->paginate(10);

        $product_ranks = Product::publish()->where('category_id',$category->id)->orderBy('created_at','desc')->paginate(10);

        $child_categories = $category->mProductChildCategory; //子カテゴリーとれてる

        $parent_category_flg = 1;

        return view('product.index', compact('products', 'product_ranks', 'category', 'child_categories', 'parent_category_flg'));
    }

    public function show(MProductChildCategory $child_category)
    {
        $products = Product::publish()->where('category_id',$child_category->id)->orderBy('created_at','desc')->paginate(10);

        $all_child_categories = $child_category->mProductCategory->mProductChildCategory; //親かて、コレクション

        $child_category_id = $child_category->id;

        $parent_category_flg = 0;

        return view('product.index', compact('products', 'all_child_categories', 'child_category', 'child_category_id', 'parent_category_flg'));
    }
}
