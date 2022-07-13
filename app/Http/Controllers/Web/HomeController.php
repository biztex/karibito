<?php

namespace App\Http\Controllers\Web;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\Product;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\MProductCategory;
use App\Libraries\Age;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * トップ画面を表示する
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {

        // 公開&&下書きでない
        $products = Product::publish()->orderBy('created_at','desc')->paginate(10);
        foreach($products as $product)
        {
            $product_category_id[] = $product->mProductChildCategory->mProductCategory->id;
        }
        $product_category_ranks = MProductCategory::whereIn('id',$product_category_id)->orderBy('created_at','desc')->paginate(9);
       
        $job_requests = JobRequest::publish()->orderBy('created_at','desc')->paginate(10);
        foreach($job_requests as $job_request)
        {
            $job_category_id[] = $job_request->mProductChildCategory->mProductCategory->id;
        }
        $job_category_ranks = MProductCategory::whereIn('id', $job_category_id)->orderBy('created_at','desc')->paginate(9);
      
        $news_list = News::orderBy('created_at','desc')->paginate(5);
     
        return view('index', compact('products','job_requests','product_category_ranks','job_category_ranks','news_list'));
        

    }
}
