<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use App\Models\Product;
use App\Models\User;
use App\Libraries\Age;
use App\Libraries\DiffDateTime;
use Illuminate\Http\Request;
use App\Services\JobRequestService;
use App\Http\Requests\JobRequestController\DraftRequest;
use App\Http\Requests\JobRequestController\StoreRequest;

class JobRequestController extends Controller
{
    private $job_request_service;

    public function __construct(JobRequestService $job_request_service)
    {
        $this->job_request_service = $job_request_service;
    }

    public function draft()
    {
        // 下書きのみ表示
        $products = Product::where('user_id',\Auth::id())
            ->where('is_draft',Product::IS_DRAFT)
            ->orderBy('updated_at','desc')
            ->paginate(10);

        $job_requests = JobRequest::where('user_id',\Auth::id())
            ->where('is_draft',JobRequest::IS_DRAFT)
            ->orderBy('updated_at','desc')
            ->paginate(10);

        return view('post.draft', compact('products','job_requests'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 下書き・非公開除いて表示
        $products = Product::where('user_id',\Auth::id())
            ->where('status',Product::STATUS_PUBLISH)
            ->where('is_draft',Product::NOT_DRAFT)
            ->orderBy('updated_at','desc')
            ->paginate(10);

        $job_requests = JobRequest::where('user_id',\Auth::id())
            ->where('status',JobRequest::STATUS_PUBLISH)
            ->where('is_draft',JobRequest::NOT_DRAFT)
            ->orderBy('updated_at','desc')
            ->paginate(10);

        return view('post.publication', compact('products','job_requests'));
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
     * @param StoreRequest $request
     * 
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
     * @param \App\Models\JobRequest $job_request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(JobRequest $job_request)
    {
        $user = User::find($job_request->user_id);

        $age = Age::group($user->userProfile->birthday);
        
        $day1 = now();
        $day2 = $job_request->application_deadline;
        $diff_date_time = DiffDateTime::diff_date_time($day1, $day2);

        return view('job_request.show',compact('job_request','user','age','diff_date_time'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\JobRequest $job_request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(JobRequest $job_request)
    {
        return view('job_request.edit',compact('job_request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param \App\Models\JobRequest $job_request
     * 
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
     * @param \App\Models\JobRequest $job_request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobRequest $job_request)
    {
        \DB::transaction(function () use ($job_request) {
            
            $job_request->delete(); // データ論理削除
            \Session::put('flash_msg','リクエストを削除しました');
            
        });
        return redirect()->route('mypage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DraftRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function storeDraft(DraftRequest $request)
    {
        $job_request = $this->job_request_service->storeDraftJobRequest($request->all());

        return redirect()->route('draft')->with('flash_msg','下書きに保存しました！');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DraftRequest $request
     * @param \App\Models\JobRequest $job_request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateDraft(DraftRequest $request, JobRequest $job_request)
    {
        $this->job_request_service->updateDraftJobRequest($request->all(), $job_request);

        return redirect()->route('draft')->with('flash_msg','下書きに保存しました！');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PreviewRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function preview(StoreRequest $request)
    {
        $user = \Auth::user();

        $age = Age::group($user->userProfile->birthday);

        $day1 = now();
        $day2 = $request->application_deadline;
        $diff_date_time = DiffDateTime::diff_date_time($day1, $day2);

        return view('job_request.preview',compact('request','user','age','diff_date_time'));
    }

    /**
     * プレビュー画面から投稿
     */
    public function storePreview(StoreRequest $request)
    {
        $this->job_request_service->storeJobRequest($request->all());

        return redirect()->route('service_thanks');
    }

    /**
     * 既存リクエスト、編集からプレビュー表示
     */
    public function editPreview(StoreRequest $request, JobRequest $job_request)
    {
        $user = \Auth::user();

        $age = Age::group($user->userProfile->birthday);

        $day1 = now();
        $day2 = $request->application_deadline;
        $diff_date_time = DiffDateTime::diff_date_time($day1, $day2);

        return view('job_request.preview',compact('request','user','age','job_request','diff_date_time'));
    }

    /**
     * プレビュー画面から投稿
     */
    public function updatePreview(StoreRequest $request, JobRequest $job_request)
    {
        $this->job_request_service->updateJobRequest($request->all(), $job_request);

        return redirect()->route('service_thanks');
    }
}
