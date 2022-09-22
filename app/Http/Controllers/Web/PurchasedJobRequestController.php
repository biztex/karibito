<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Chatroom;
use App\Models\PurchasedJobRequest;
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
        $job_request = PurchasedJobRequest::find($chatroom->referencePurchased->id);

        return view('purchased_job_request.show',compact('job_request'));
    }
}
