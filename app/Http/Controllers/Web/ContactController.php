<?php

namespace App\Http\Controllers\Web;

use App\Models\ContactMailHistory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserContactService;
use App\Services\AdminContactService;
use App\Models\JobRequest;
use App\Models\Product;

class ContactController extends Controller
{
    private $admin_mail;
    private $user_mail;

    public function __construct(AdminContactService $admin_mail, UserContactService $user_mail)
    {
        $this->admin_mail = $admin_mail;
        $this->user_mail  = $user_mail;
    }

    /**
     * コンタクト画面を表示する
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function contact(Request $request)
    {
        // 商品かリクエストのIDが渡ったら変数に格納
        if ($request->product_id) {
            $report_product_id = $request->product_id;
            $report_product_title = Product::find($report_product_id)->title;
            return view('contact', compact('report_product_title', 'report_product_id'));
        } elseif ($request->job_request_id) {
            $report_job_request_id = $request->job_request_id;
            $report_job_request_title = JobRequest::find($report_job_request_id)->title;
            return view('contact', compact('report_job_request_title', 'report_job_request_id'));
        } else {
            return view('contact');
        }
    }

    /**
     * 下書き一覧画面を表示する
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function indexDraft()
    {
        return view('sample.draft');
    }

    public function sendSupportMail(Request $request)
    {
        $rule = [
            'name' => ['required', 'string', 'max:255'],
            'mail' => ['required', 'string', 'email', 'max:128'],
            'message' => ['required', 'string'],
        ];
        if(\Auth::User() == null) {
            $rule = [
                'name' => ['required', 'string', 'max:255'],
                'mail' => ['required', 'string', 'email', 'max:128'],
                'terms' => 'required',
                'over_15' => 'required',
                'message' => ['required', 'string'],
            ];
        }
        $request->validate($rule);

        $this->admin_mail->sendMail($request);
        $this->user_mail->sendMail($request);
        return redirect()->route("contact")->with('flash_msg', 'お問い合わせありがとうございます。内容確認の上、ご連絡させていただきます。');
    }
}
