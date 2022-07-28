<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\AdminProductSearchService;

class ProductController extends Controller
{
    private $product_search;

    public function __construct(AdminProductSearchService $product_search)
    {
        $this->product_search = $product_search;
    }

    public function index()
    {
        $products = Product::orderBy('id')->paginate(50);

        return view('admin.product.index',compact('products'));
    }

    public function search(Request $request)
    {
        $products = $this->product_search->searchJobRequest($request);

        return view('admin.product.index',compact('products', 'request'));
    }
}
