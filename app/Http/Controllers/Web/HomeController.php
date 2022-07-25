<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\JobRequest;
use App\Models\Product;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\MProductCategory;
use App\Libraries\Age;
use Illuminate\Support\Facades\Auth;
use App\Services\HomeService;

class HomeController extends Controller
{


    private $home_service;

    public function __construct(HomeService $home_service)
    {
        $this->home_service = $home_service;
    }

    /**
     * トップ画面を表示する
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        // 公開&&下書きでない
        $products = $this->home_service->paginateProduct(10);

        $product_category_ranks = $this->home_service->getProductCategoryRanks(9);

        $job_requests = $this->home_service->paginateJobRequest(10);

        $job_category_ranks = $this->home_service->getJobRequestCategoryRanks(9);

        $news_list = $this->home_service->paginateNewsList(5);

        $important_news_list = $this->home_service->paginateImportantNewsList(3);

        return view('index', compact('products','job_requests','product_category_ranks','job_category_ranks','news_list','important_news_list'));
    }
}
