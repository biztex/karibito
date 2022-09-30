<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfile\RegisterTelRequest;
use App\Services\UserProfileService;

class ChangeTelController extends Controller
{
    private UserProfileService $user_profile_service;

    public function __construct(UserProfileService $user_profile_service)
    {
        $this->user_profile_service = $user_profile_service;
    }

    public function edit()
    {
        return view('setting.tel');
    }

    public function update(RegisterTelRequest $request)
    {
        \DB::transaction(function () use($request) {
            $this->user_profile_service->updateTel($request->tel);
            \Session::put('flash_msg', '電話番号を登録しました。');
        });
        return back();
    }
}
