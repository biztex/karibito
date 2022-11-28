<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mypage\ChangeEmailController\SendChangeEmailLinkRequest;
use App\Services\ChangeEmailService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Mypage\ChangeEmailController\StoreSubEmailRequest;

class ChangeEmailController extends Controller
{
    public function __construct(ChangeEmailService $change_email_service)
    {
        $this->change_email_service = $change_email_service;
    }

    public function edit()
    {
        return view('setting.email');
    }

    // メールアドレス変更確認メール送信
    public function sendChangeEmailLink(SendChangeEmailLinkRequest $request)
    {
        $send_change_email_res = $this->change_email_service->sendChangeEmailLink($request);

        if($send_change_email_res){
            return back()->with('flash_msg', '確認メールを送信しました。');
        } else {
            return back()->with('flash_msg', 'メール更新に失敗しました。');
        }
    }

    // メールアドレス変更（更新）
    public function updateEmail($token)
    {
        $update_email_res = $this->change_email_service->updateEmail($token);

        if($update_email_res){
            return redirect()->route('setting.index')->with('flash_msg', 'メールアドレスを更新しました！');
        } else {
            return redirect()->route('setting.index')->with('flash_msg', 'トークンの有効期限が切れているか、トークンが不正です。');
        }
    }

    // サブメール
    public function subMailCreate()
    {
        $user =  Auth::user();
        return view('setting/sub_email.create',  compact('user'));
    }

    // サブメール登録と更新処理
    public function subMailStore(StoreSubEmailRequest $request)
    {
        Auth::user()->sub_email = $request->sub_email;
        Auth::user()->save();
        return to_route('setting.index');
    }

    public function subMailDestroy()
    {
        Auth::user()->sub_email = null;
        Auth::user()->save();
        return to_route('setting.index');
    }
}
