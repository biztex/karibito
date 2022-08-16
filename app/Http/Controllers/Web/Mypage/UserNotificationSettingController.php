<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\UserNotificationSetting;
use App\Services\UserNotificationSettingService;

class UserNotificationSettingController extends Controller
{

    private $notification_setting_service;

    public function __construct(UserNotificationSettingService $notification_setting_service)
    {
        $this->notification_setting_service = $notification_setting_service;
    }

    public function update(Request $request)
    {
        // dd($request);
        $id = Auth::user()->userNotificationSetting->id;
        $this->notification_setting_service->updateSetting($request->all(), $id);

        return redirect()->route('setting.index')->with('flash_msg', 'お知らせ受信の設定を変更しました。');
    }
}
