<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mypage\ChangeEmailController\SendChangeEmailLinkRequest;
use App\Services\ChangeEmailService;
use Illuminate\Http\Request;

class ChangeEmailController extends Controller
{
    public function __construct(ChangeEmailService $change_email_service)
    {
        $this->change_email_service = $change_email_service;
    }

    // メールアドレス変更確認メール送信
    public function sendChangeEmailLink(SendChangeEmailLinkRequest $request)
    {
        $this->change_email_service->sendChangeEmailLink($request);
    }

    // メールアドレス変更（更新）
    public function updateEmail($token)
    {
        $this->change_email_service->updateEmail($token);
    }
}
