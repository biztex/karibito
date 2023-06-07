<?php

namespace App\Services;

use App\Models\News;
use App\Models\Product;
use App\Models\JobRequest;
use App\Models\MProductCategory;

class HomeService
{

    // おすすめ10件で使用
    public function paginateProduct($i)
    {
        $products = Product::with(['mProductChildCategory', 'mProductChildCategory.mProductCategory', 'productImage', 'user', 'user.userProfile', 'user.userProfile.prefecture', 'user.evaluations'])
            // ->otherUsers()  今後自分以外のユーザーの商品のみ表示するときに使用
            ->publish()
            ->orderBy('view_count', 'desc') // 閲覧回数が多い順
            ->orderBy('created_at', 'desc')
            ->paginate($i);

        return $products;
    }

    // カテゴリー別で使用 (全ての自分以外の公開・下書きでないもの)
    public function publishProducts()
    {
        $products = Product::with(['mProductChildCategory', 'mProductChildCategory.mProductCategory', 'productImage', 'user', 'user.userProfile', 'user.userProfile.prefecture', 'user.evaluations'])
            // ->otherUsers() 今後自分以外のユーザーの商品のみ表示するときに使用
            ->publish()
            ->orderBy('view_count','desc')
            ->latest()
            ->get(); // 公開&&下書きでない

        return $products;
    }

    // カテゴリー別のカテゴリー9件
    // 公開のproductが存在するカテゴリー全て取得
    // 順番(最初に表示される9件)は確認中
    public function getProductCategoryRanks()
    {
        $products = $this->publishProducts();

        $product_category_id = [];
        foreach($products as $product)
        {
            $product_category_id[] = $product->mProductChildCategory->mProductCategory->id;
        }
        // $product_category_ranks = MProductCategory::whereIn('id',$product_category_id)->orderBy('created_at','desc')->paginate($i);
        $product_category_ranks = MProductCategory::whereIn('id',$product_category_id)->orderBy('created_at','desc')->get();

        return $product_category_ranks;
    }

    // おすすめ10件で使用
    public function paginateJobRequest($i)
    {
        $job_requests = JobRequest::with(['mProductChildCategory', 'mProductChildCategory.mProductCategory', 'user', 'user.userProfile', 'user.userProfile.prefecture', 'user.evaluations'])
            ->display()
            ->orderBy('view_count', 'desc') // 閲覧回数が多い順
            ->orderBy('created_at','desc')
            ->paginate($i);

        return $job_requests;
    }

    // カテゴリー別で使用 (全ての自分以外の公開・下書きでないもの)
    public function publishJobRequests()
    {
        $job_requests = JobRequest::with(['mProductChildCategory', 'mProductChildCategory.mProductCategory', 'user', 'user.userProfile', 'user.userProfile.prefecture', 'user.evaluations'])
            ->display()
            ->orderBy('view_count','desc')
            ->latest()
            ->get();

        return $job_requests;
    }

    // カテゴリー別のカテゴリー9件
    // 公開のjob_requestが存在するカテゴリー全て取得
    // 順番(最初に表示される9件)は確認中
    public function getJobRequestCategoryRanks()
    {
        $job_requests = $this->publishJobRequests();

        $job_category_id = [];
        foreach($job_requests as $job_request)
        {
            $job_category_id[] = $job_request->mProductChildCategory->mProductCategory->id;
        }
        // $job_category_ranks = MProductCategory::whereIn('id', $job_category_id)->orderBy('created_at','desc')->paginate($i);
        $job_category_ranks = MProductCategory::whereIn('id', $job_category_id)->orderBy('created_at','desc')->get();

        return $job_category_ranks;
    }

    public function paginateNewsList($i)
    {
        $news_list = News::orderBy('created_at','desc')->paginate($i);

        return $news_list;
    }

    public function paginateImportantNewsList($i)
    {
        $important_news_list = News::orderBy('created_at','desc')->where('is_important', 1)->paginate($i);

        return $important_news_list;
    }

    }

