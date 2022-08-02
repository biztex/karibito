<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Services\UserProfileService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private readonly PaymentService $payment_service;
    private $user_profile_service;

    public function __construct(PaymentService $payment_service, UserProfileService $user_profile_service)
    {
        $this->payment_service = $payment_service;
        $this->user_profile_Service = $user_profile_service;
    }


    public function create()
    {
        return view('member.member_config.card');
    }

    /**
     * クレジットカード登録 (顧客登録)
     * @param Request $request
     * @return void
     */
    public function createCard(Request $request)
    {
        \DB::transaction(function () use ($request) {

            if(\Auth::user()->payjp_customer_id === null) {
                $customer_id = $this->payment_service->createCustomer();
                $this->user_profile_service->createPayjpCustomer($customer_id);
            } else {
                $customer_id = $this->payment_service->getCustomer();
            }

            $this->payment_service->createCard($customer_id, $request->all());
        });
        return back();
    }
}
