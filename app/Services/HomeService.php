<?php

namespace App\Services;

use App\Models\News;
use App\Models\User;
use App\Models\Product;
use App\Models\JobRequest;
use App\Models\MProductCategory;

class HomeService
{

    public function paginateProduct($i)
    {
        $products = Product::publish()->orderBy('created_at','desc')->paginate($i); // 公開&&下書きでない

        return $products;
    }

    public function getProductCategoryRanks($i)
    {
        $products = $this->paginateProduct(10);
        foreach($products as $product)
        {
            $product_category_id[] = $product->mProductChildCategory->mProductCategory->id;
        }
        $product_category_ranks = MProductCategory::whereIn('id',$product_category_id)->orderBy('created_at','desc')->paginate($i);

        return $product_category_ranks;
    }

    public function paginateJobRequest($i)
    {
        $job_requests = JobRequest::publish()->orderBy('created_at','desc')->paginate($i);

        return $job_requests;
    }

    public function getJobRequestCategoryRanks($i)
    {
        $job_requests = $this->paginateJobRequest(10);
        foreach($job_requests as $job_request)
        {
            $job_category_id[] = $job_request->mProductChildCategory->mProductCategory->id;
        }
        $job_category_ranks = MProductCategory::whereIn('id', $job_category_id)->orderBy('created_at','desc')->paginate($i);

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

