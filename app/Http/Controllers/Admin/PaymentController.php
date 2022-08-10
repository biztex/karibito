<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\AdminPaymentService;
use App\Services\CsvService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private readonly AdminPaymentService $admin_payment_service;
    private $csv_service;

    public function __construct(AdminPaymentService $admin_payment_service, CsvService $csv_service) 
    {
        $this->admin_payment_service = $admin_payment_service;
        $this->csv_service = $csv_service;

    }

    /**
     * 一覧画面
     */
    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')->paginate(50);

        return view('admin.payment.index', compact('payments'));
    }

    /**
     * ユーザー検索
     */
    public function search(Request $request)
    {
        $payments = $this->admin_payment_service->searchUser($request);

        return  view('admin.payment.index', compact('payments', 'request'));
    }

    /**
     * 振込csvダウンロード
     */
    public function download()
    {
        $pays = Payment::all();

        if($pays->isNotEmpty()) {
            $data = [];

            foreach ($pays as $value) {
                $array_data = [
                    $value->purchase->chatroom->sellerUser->bankAccount->bank_code, // 銀行コード
                    $value->purchase->chatroom->sellerUser->bankAccount->branch_code, // 支店コード
                    $value->purchase->chatroom->sellerUser->bankAccount->type, // 預金種目
                    \Crypt::decryptString($value->purchase->chatroom->sellerUser->bankAccount->number), // 口座番号
                    \Crypt::decryptString($value->purchase->chatroom->sellerUser->bankAccount->name), // 受取人名
                    $value->amount, // 振込金額
                    null, // 顧客コード
                    null, // 識別表示
                ];
                array_push($data, $array_data);
            }

        $csv_data = $this->csv_service->createCsv($data, null, 'GMOあおぞら用振込申請');
        
        return \Response::make($csv_data['csv'], 200, $csv_data['headers']);
    } else {
        return back()->with('flash_msg', 'CSV作成対象の振込申請がありませんでした。');
    }
    }
}
