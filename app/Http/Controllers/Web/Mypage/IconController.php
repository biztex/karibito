<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserProfileService;

class IconController extends Controller
{
    private $user_profile_service;

    public function __construct(UserProfileService $user_profile_service)
    {
        $this->user_profile_service = $user_profile_service;
    }

    /**
     * アイコン画像の削除
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete()
    {
        \DB::transaction(function () {
            $this->user_profile_service->deleteUserProfileImage('icon');
            \Session::put('flash_msg','アイコンを削除しました！');
        });
        return back();
    }
}
