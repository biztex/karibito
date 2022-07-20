<?php

namespace App\Http\Controllers\Web\OtherUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\JobRequest;
use App\Models\MProductCategory;
use App\Services\HomeService;


class ProductController extends Controller
{

    private $home_service;

    public function __construct(HomeService $home_service)
    {
        $this->home_service = $home_service;
    }


    public function getProducts($i) //イラン
    {
        $products = $this->home_service->paginateProduct($i);
        return $products;
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(MProductCategory $category)
    {
        $products = Product::publish()->where('id',$category->id)->orderBy('created_at','desc');

        $child_categories = $category->mProductChildCategory; //子カテゴリーとれてる

        // $product_ranks = Product::where('id',$category);

        // $products = $this->paginateProduct(10);
        // foreach($products as $product)
        // {
        //     $product_category_id[] = $product->mProductChildCategory->mProductCategory->id;
        // }
        // $product_category_ranks = MProductCategory::whereIn('id',$product_category_id)->orderBy('created_at','desc')->paginate(10); カテゴリーを取ってる

        // dd($products);

        // $product_category_ranks = Product::where('category_id', $id);
        // dd($product_category_ranks);

        // $product_category_ranks = $this->home_service->getProductCategoryRanks(9);
        // dd($product_category_ranks);

        return view('product.index', compact('products', 'category', 'child_categories'));
    }

    // public function getProductCategoryRanks($i)
    // {
    //     $products = $this->getProduct(10);

    //     $product_category_ranks = $this->home_service->getProductCategoryRanks(9);

    //     return $product_category_ranks;
    // }
}
