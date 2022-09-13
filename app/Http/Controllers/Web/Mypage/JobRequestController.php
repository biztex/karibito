<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use App\Models\Product;
use App\Models\Chatroom;
use App\Models\User;
use App\Models\Favorite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\JobRequestService;
use App\Http\Requests\JobRequestController\DraftRequest;
use App\Http\Requests\JobRequestController\StoreRequest;
use App\Services\UserNotificationService;

class JobRequestController extends Controller
{
    private $job_request_service;
    private $user_notification_service;

    public function __construct(JobRequestService $job_request_service, UserNotificationService $user_notification_service)
    {
        $this->job_request_service = $job_request_service;
        $this->user_notification_service = $user_notification_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function draft()
    {
        // 下書きのみ表示
        $products = Product::loginUsers()->draft()->orderBy('created_at','desc')->paginate(10);
        $job_requests = JobRequest::loginUsers()->draft()->orderBy('created_at','desc')->paginate(10);

        return view('mypage.draft.index', compact('products','job_requests'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        // 下書き除いて表示
        $products = Product::loginUsers()->notDraft()->orderBy('created_at','desc')->paginate(10);
        $job_requests = JobRequest::loginUsers()->notDraft()->orderBy('created_at','desc')->paginate(10);

        return view('mypage.publication.index', compact('products','job_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(Request $request)
    {
        return view('job_request.create', compact('request'));
    }

    public function postCreate(Request $request)
    {
        return view('job_request.create',compact('request'));
    }

    // 編集⇒プレビュー⇒編集
    public function postEdit(Request $request, JobRequest $job_request)
    {
        $job_request = $request;
        return view('job_request.edit', compact('request','job_request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        // バリデーションかかれば入力画面に戻す
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return redirect()->route("job_request.create")->withErrors($validator)->withInput();
        }

        $this->job_request_service->storeJobRequest($request->all());

        $job_request = JobRequest::orderBy('created_at', 'desc')->where('user_id', \Auth::id())->first();
        $url = $this->job_request_service->getURL($job_request->id);

        $this->user_notification_service->storeUserNotificationPost($job_request);

        return redirect()->route('job_request.thanks')->with(['url' => $url, 'product_title' => $job_request->title, 'name' => $job_request->user->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\JobRequest $job_request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(JobRequest $job_request)
    {
        $user = User::find($job_request->user_id);
        $deadline = new Carbon(date("Y-m-d",strtotime("$job_request->application_deadline")));
        $today = new Carbon('today');

        $requested = Chatroom::requested($job_request->id);
        $url = $this->job_request_service->getURL($job_request->id);

        $is_favorite = Favorite::jobRequest()->where('reference_id', $job_request->id)->first();

        $this->user_notification_service->isView($job_request);

        return view('job_request.show',compact('job_request','user', 'deadline', 'today', 'requested', 'url', 'is_favorite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\JobRequest $job_request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreRequest $request, JobRequest $job_request)
    {
        // バリデーションかかれば入力画面に戻す
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return redirect()->route("job_request.edit", $job_request->id)->withErrors($validator)->withInput();
        }

        $this->job_request_service->updateJobRequest($request->all(), $job_request);

        $job_request = JobRequest::orderBy('created_at', 'desc')->where('user_id', \Auth::id())->first();
        $url = $this->job_request_service->getURL($job_request->id);

        $this->user_notification_service->storeUserNotificationFavorite($job_request);

        return redirect()->route('job_request.thanks')->with(['url' => $url, 'product_title' => $job_request->title, 'name' => $job_request->user->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\JobRequest $job_request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(JobRequest $job_request)
    {
        $job_request->delete(); // データ論理削除
        \Session::put('flash_msg','リクエストを削除しました');

        if ($job_request->is_draft == JobRequest::NOT_DRAFT) {
            return redirect()->route('publication',['#job-request']);
        } else {
            return redirect()->route('draft',['#job-request']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DraftRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDraft(DraftRequest $request)
    {
        $this->job_request_service->storeDraftJobRequest($request->all());

        return redirect()->route('draft','#job-request')->with('flash_msg','下書きに保存しました！');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DraftRequest $request
     * @param \App\Models\JobRequest $job_request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDraft(DraftRequest $request, JobRequest $job_request)
    {
        $this->job_request_service->updateDraftJobRequest($request->all(), $job_request);

        return redirect()->route('draft','#job-request')->with('flash_msg','下書きに保存しました！');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function preview(StoreRequest $request)
    {
        // バリデーションかかれば入力画面に戻す
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return redirect()->route('job_request.create')->withErrors($validator)->withInput();
        }

        $user = \Auth::user();

        $date = new Carbon($request->application_deadline);
        $diff_time = $date->addDay()->diffForHumans(Carbon::now());


        return view('job_request.preview',compact('request','user','diff_time'));
    }

    /**
     * プレビュー画面から投稿
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePreview(StoreRequest $request)
    {
        // バリデーションかかれば入力画面に戻す
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return redirect()->route('job_request.create')->withErrors($validator)->withInput();
        }
        $this->job_request_service->storeJobRequest($request->all());

        $job_request = JobRequest::orderBy('created_at', 'desc')->where('user_id', \Auth::id())->first();
        $url = $this->job_request_service->getURL($job_request->id);

        return redirect()->route('job_request.thanks')->with(['url' => $url, 'product_title' => $job_request->title, 'name' => $job_request->user->name]);
    }

    /**
     * 既存リクエスト、編集からプレビュー表示
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPreview(StoreRequest $request, JobRequest $job_request)
    {
        // バリデーションかかれば入力画面に戻す
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return redirect()->route("job_request.edit" ,$job_request->id)->withErrors($validator)->withInput();
        }

        $user = \Auth::user();

        $date = new Carbon($request->application_deadline);
        $diff_time = $date->addDay()->diffForHumans(Carbon::now());

        return view('job_request.preview',compact('request','user','job_request','diff_time'));
    }

    /**
     * プレビュー画面から投稿
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePreview(StoreRequest $request, JobRequest $job_request)
    {
        $this->job_request_service->updateJobRequest($request->all(), $job_request);

        $job_request = JobRequest::orderBy('created_at', 'desc')->where('user_id', \Auth::id())->first();
        $url = $this->job_request_service->getURL($job_request->id);

        return redirect()->route('job_request.thanks')->with(['url' => $url, 'product_title' => $job_request->title, 'name' => $job_request->user->name]);
    }
}
