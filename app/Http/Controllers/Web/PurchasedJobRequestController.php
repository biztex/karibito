<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PurchasedJobRequest;
use Illuminate\Http\Request;

class PurchasedJobRequestController extends Controller
{
    public function show(PurchasedJobRequest $job_request)
    {
        return view('purchased_job_request.show',compact('job_request'));
    }
}
