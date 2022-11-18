<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Requests\UserProfile\StoreRequest;
use App\Http\Requests\UserProfile\FriendCodeRequest;
use App\Http\Requests\UserProfile\UpdateRequest;
use App\Http\Requests\UserProfile\UpdateCanCallRequest;

use App\Services\UserProfileService;

class UserProfileController extends Controller
{
    private $user_profile_service;

    public function __construct(UserProfileService $user_profile_service)
    {
        $this->user_profile_service = $user_profile_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route('mypage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('auth.profile-create');
    }

    public function friend_code(FriendCodeRequest $request)
    {
        $name = $request->name;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $gender = $request->gender;
        $prefecture_id = $request->prefecture_id;

        return view('auth.friend_code', compact('name','first_name', 'last_name', 'gender', 'prefecture_id'));
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
        \DB::transaction(function () use ($request) {
            $this->user_profile_service->updateUserName($request->name);
            $this->user_profile_service->storeUserProfile($request->all());
        });

        return redirect()->route('complete.show');
    }

    /**
     * 基本情報登録完了画面
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showComplete()
    {
        return view('auth.profile-created');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $this->user_profile_service->updateUserName($request->name);
            $this->user_profile_service->updateUserProfile($request->all());
            $this->user_profile_service->updateUserProfileImage($request->all(),'cover', UserProfile::RESIZE_WIDTH_COVER);
            $this->user_profile_service->updateUserProfileImage($request->all(),'icon', UserProfile::RESIZE_WIDTH_ICON);
            $this->user_profile_service->updateSpecialty($request->profile_content);
            \Session::put('flash_msg','プロフィールを編集しました！');
        });

        return back();
    }
    
    /**
     * Display the specified resource.
     * @param UpdateCanCallRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCanCall(UpdateCanCallRequest $request)
    {
        $this->user_profile_service->updateCanCall($request->can_call);
        return back();
    }
}
