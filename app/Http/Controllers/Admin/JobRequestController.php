<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use Illuminate\Http\Request;
use App\Services\AdminJobRequestSearchService;

class JobRequestController extends Controller
{

    private $job_request_search;

    public function __construct(AdminJobRequestSearchService $job_request_search)
    {
        $this->job_request_search = $job_request_search;
    }

    public function index()
    {
        $job_requests = JobRequest::orderBy('id')->paginate(50);

        return view('admin.job_request.index',compact('job_requests'));
    }

    public function search(Request $request)
    {
        $job_requests = $this->job_request_search->searchJobRequest($request);

        return view('admin.job_request.index',compact('job_requests', 'request'));
    }
}
