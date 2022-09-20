<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private readonly PaymentService $payment_service;

    public function __construct(PaymentService $payment_service)
    {
        $this->payment_service = $payment_service;
    }

    public function index()
    {
        $withdrawals = $this->payment_service->getUserWithdrawals(\Auth::id());

        return view('mypage.payment.index', compact('withdrawals'));
    }

}
