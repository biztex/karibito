<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\AdminPaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private readonly AdminPaymentService $admin_payment_service;

    public function __construct(AdminPaymentService $admin_payment_service) 
    {
        $this->admin_payment_service = $admin_payment_service;

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
}
