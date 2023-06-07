<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        // 公開&&下書きでない・一旦自分のものも表示
        $recommend_products = $this->home_service->paginateProduct(10); // おすすめ10件（選定確認中）
        $product_category_ranks = $this->home_service->getProductCategoryRanks(); // カテゴリー別のカテゴリー9件 表示回数順
        $products = $this->home_service->publishProducts(); // カテゴリー別の中身を10件ずつ (選定確認中)
        // $products = $this->home_service->paginateProduct(10);
        // $product_category_ranks = MProductCategory::all();

        $recommend_job_requests = $this->home_service->paginateJobRequest(10);
        $job_category_ranks = $this->home_service->getJobRequestCategoryRanks();
        $job_requests = $this->home_service->publishJobRequests();
        // $job_category_ranks = $this->home_service->getJobRequestCategoryRanks(9);
        // $job_category_ranks = MProductCategory::all();

        $news_list = $this->home_service->paginateNewsList(5);

        $important_news_list = $this->home_service->paginateImportantNewsList(3);

        return view('index', compact('products', 'recommend_products','job_requests', 'recommend_job_requests', 'product_category_ranks','job_category_ranks','news_list','important_news_list'));
    }
}
