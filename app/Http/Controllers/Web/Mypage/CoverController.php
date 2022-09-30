<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserProfile\UpdateCoverRequest;
use App\Services\UserProfileService;
use App\Models\UserProfile;

class CoverController extends Controller
{
    private $user_profile_service;

    public function __construct(UserProfileService $user_profile_service)
    {
        $this->user_profile_service = $user_profile_service;
    }

    /**
     * マイページよりカバー画像のみ変更
     * @param UpdateCoverRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCoverRequest $request) 
    {
        \DB::transaction(function () use ($request) {
            $this->user_profile_service->updateUserProfileImage($request->all(),'cover',UserProfile::RESIZE_WIDTH_COVER);
            \Session::put('flash_msg','カバーを変更しました！');
        });
        return back();
    }

    /**
     * カバー画像の削除
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete() 
    {
        \DB::transaction(function () {
            $this->user_profile_service->deleteUserProfileImage('cover');
            \Session::put('flash_msg','カバーを削除しました！');
        });
        return back();
    }
}