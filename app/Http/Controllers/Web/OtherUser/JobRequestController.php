<?php

namespace App\Http\Controllers\Web\OtherUser;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use App\Models\MProductCategory;
use App\Models\MProductChildCategory;
use App\Services\HomeService;
use Illuminate\Http\Request;
use App\Services\JobRequestService;


class JobRequestController extends Controller
{


    private $job_request_service;

    public function __construct(JobRequestService $job_request_service, HomeService $home_service)
    {
        $this->job_request_service = $job_request_service;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(MProductCategory $category)
    {
        $job_requests = JobRequest::publish()->where('category_id',$category->id)->orderBy('created_at','desc')->paginate(10);

        $job_request_ranks = JobRequest::publish()->where('category_id',$category->id)->orderBy('created_at','desc')->paginate(10);

        $child_categories = $category->mProductChildCategory; //子カテゴリーとれてる

        $parent_category_flg = 1;

        return view('job_request.index', compact('job_requests', 'job_request_ranks', 'category', 'child_categories', 'parent_category_flg'));
    }

    public function show(MProductChildCategory $child_category)
    {
        $job_requests = JobRequest::publish()->where('category_id',$child_category->id)->orderBy('created_at','desc')->paginate(10);

        $all_child_categories = $child_category->mProductCategory->mProductChildCategory; //親かて、コレクション

        $child_category_id = $child_category->id;

        $parent_category_flg = 0;

        return view('job_request.index', compact('job_requests', 'all_child_categories', 'child_category', 'child_category_id', 'parent_category_flg'));
    }

    public function search(Request $request)
    {
        $job_requests = $this->job_request_service->searchJobRequests($request);
        $prefecture_id = $request->prefecture_id;
        $low_price = $request->low_price;
        $high_price = $request->high_price;
        $is_online = $request->is_online;
        $age_period = $request->age_period;
        $sort = $request->sort;
        $keyword = $request->keyword;
        $parent_category_id = $request->parent_category_id;
        $child_category_id = $request->child_category_id;

        return view('job_request.index', compact('job_requests', 'prefecture_id', 'low_price', 'high_price', 'is_online', 'age_period', 'sort', 'keyword', 'parent_category_id', 'child_category_id'));
    }
}
