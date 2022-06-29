<?php

namespace App\Http\Controllers;

use App\Models\ContactMailHistory;
use Illuminate\Http\Request;
use App\Services\UserContactService;
use App\Services\AdminContactService;

class ContactController extends Controller
{
    /**
     * コンタクト画面を表示する
     *
     * @return view
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * 下書き一覧画面を表示する
     *
     * @return view
     */
    public function indexDraft()
    {
        return view('sample.draft');
    }

    public function sendSupportMail(Request $request)
    {
        AdminContactService::sendMail($request);
        UserContactService::sendMail($request);
        return redirect()->route("contact")->with('flash_msg', 'お問い合わせありがとうございます。内容確認の上、ご連絡させていただきます。');
    }
}
