<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use App\Models\User;
use App\Libraries\Age;
use Illuminate\Http\Request;
use App\Services\JobRequestService;
use App\Http\Requests\JobRequestController\StoreRequest;


class JobRequestController extends Controller
{
    private $job_request_service;

    public function __construct(JobRequestService $job_request_service)
    {
        $this->job_request_service = $job_request_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('job_request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->job_request_service->storeJobRequest($request->all());

        return redirect()->route('service_thanks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobRequest  $job_request
     * @return \Illuminate\Http\Response
     */
    public function show(JobRequest $job_request)
    {
        $user = User::find($job_request->user_id);

        $birthday = (int)str_replace("-","",$user->userProfile->birthday);
        $age = Age::group($birthday);

        return view('job_request.show',compact('jobRequest','user','age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobRequest  $job_request
     * @return \Illuminate\Http\Response
     */
    public function edit(JobRequest $job_request)
    {
        return view('job_request.edit',compact('jobRequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobRequest  $job_request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, JobRequest $job_request)
    {
        $this->job_request_service->updateJobRequest($request->all(), $job_request);

        return redirect()->route('service_thanks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobRequest  $job_request
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobRequest $job_request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDraft(Request $request)
    {
        $job_request = $this->job_request_service->storeDraftJobRequest($request->all());

        return redirect()->route('job_request.show',$job_request->id)->with('flash_msg','下書きに保存しました！');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobRequest  $job_request
     * @return \Illuminate\Http\Response
     */
    public function updateDraft(Request $request, JobRequest $job_request)
    {
        $this->job_request_service->updateDraftJobRequest($request->all(), $job_request);

        return redirect()->route('job_request.show',$job_request->id)->with('flash_msg','下書きに保存しました！');
    }

}
