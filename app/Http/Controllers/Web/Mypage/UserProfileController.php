<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Models\Prefecture;
use App\Http\Requests\UserProfile\StoreRequest;
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
            $this->user_profile_service->updateUser($request->all());
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
        $user = UserProfile::with('user')->firstWhere('user_id',\Auth::id());
        return view('auth.profile-created',compact('user'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show()
    // {
    //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $previous = url()->previous();
        \DB::transaction(function () use ($request) {

            $this->user_profile_service->updateUser($request->all());
            $this->user_profile_service->updateUserProfile($request);
            $this->user_profile_service->updateUserProfileImage($request,'cover');
            $this->user_profile_service->updateUserProfileImage($request,'icon');
            $this->user_profile_service->updateSpecialty($request->all());

        });
        \Session::put('flash_msg','プロフィールを編集しました！');

        return redirect($previous);
    }
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }

    
    /**
     * Display the specified resource.
     * @param UpdateCanCallRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCanCall(UpdateCanCallRequest $request)
    {
        $this->user_profile_service->updateCanCall($request->all());
        return back();
    }
}
