<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Chatroom;
use App\Models\PurchasedJobRequest;
use App\Services\NewsService;
use Illuminate\Http\Request;

class PurchasedJobRequestController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chatroom $chatroom)
    {
        // dd($chatroom->referencePurchased->id);
        $purchased_job_request = PurchasedJobRequest::find($chatroom->referencePurchased->id);
        // dd($purchased_job_request);
        // $object = $user_notification->reference;
        // return view('job_request.show');
        return redirect()->route('job_request.show', ['job_request' => $purchased_job_request]);
    }
}
