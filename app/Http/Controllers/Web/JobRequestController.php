<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
    public function create(Request $request)
    {
        return view('job_request.create')->with('request',$request);
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

        return view('job_request.show',compact('job_request','user','age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobRequest  $job_request
     * @return \Illuminate\Http\Response
     */
    public function edit(JobRequest $job_request)
    {
        return view('job_request.edit',compact('job_request'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobRequest  $job_request
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        $user = \Auth::user();

        $birthday = (int)str_replace("-","",$user->userProfile->birthday);
        $age = Age::group($birthday);

        return view('job_request.preview',compact('request','user','age'));
    }


    /**
     * プレビュー画面から投稿
     */
    public function storePreview(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'category_id' => 'required | integer | exists:m_product_child_categories,id',
            'prefecture_id' => 'nullable | integer | between:1,47',
            'title' => 'required | string | max:30',
            'content' => 'required | string | min:30 | max:3000 ',
            'price' => 'required | integer | min:500 | max:9990000',
            'application_deadline' => 'required | date | after_or_equal:tomorrow',
            'required_date' => 'nullable | date | after_or_equal:application_deadline',
            'is_online' => 'required | integer | boolean',
            'is_call' => 'required | integer | boolean',    
        ]);

        // バリデーション引っかかれば入力画面に戻す
        if ($validate->fails()) {
            return redirect()->route("job_request.create")->withInput()->withErrors($validate->messages());
        }

        // バリデーション通れば通常通り登録
        $this->job_request_service->storeJobRequest($request->all());

        return redirect()->route('service_thanks');
    }

}
