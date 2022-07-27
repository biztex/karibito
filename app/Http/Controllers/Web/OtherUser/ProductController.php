<?php

namespace App\Http\Controllers\Web\OtherUser;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\MProductCategory;
use App\Models\MProductChildCategory;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\JobRequestService;


class ProductController extends Controller
{


    private $product_service;
    private $job_request_service;

    public function __construct(ProductService $product_service, JobRequestService $job_request_service)
    {
        $this->product_service = $product_service;
        $this->job_request_service = $job_request_service;
    }

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

    public function search(Request $request)
    {
        $prefecture_id = $request->prefecture_id;
        $low_price = $request->low_price;
        $high_price = $request->high_price;
        $is_online = $request->is_online;
        $age_period = $request->age_period;
        $sort = $request->sort;
        $keyword = $request->keyword;
        $parent_category_id = $request->parent_category_id;
        $child_category_id = $request->child_category_id;
        $service_flg = $request->service_flg;

        if ($service_flg === '1') { //プロダクトの時
            $products = $this->product_service->searchProducts($request);
            return view('product.index', compact('products', 'prefecture_id', 'low_price', 'high_price', 'is_online', 'age_period', 'sort', 'keyword', 'parent_category_id', 'child_category_id', 'service_flg'));
        } elseif ($service_flg === '2') { //リクエストの時
            $job_requests = $this->job_request_service->searchProducts($request);
            return view('job_request.index', compact('job_requests', 'prefecture_id', 'low_price', 'high_price', 'is_online', 'age_period', 'sort', 'keyword', 'parent_category_id', 'child_category_id', 'service_flg'));
        }
    }
}
