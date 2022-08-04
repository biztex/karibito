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
        $this->user_profile_service = $user_profile_service;
    }


    public function create()
    {
        $cards = $this->payment_service->getCardList();
        return view('member.member_config.card', compact('cards'));
    }

    /**
     * クレジットカード登録 (顧客登録)
     * @param Request $request
     * @return void
     */
    public function createCard(Request $request)
    {
        $this->payment_service->createCard($request->all());

        \Session::put('flash_msg','クレジットカード情報を登録しました！');

        return redirect()->route('member_config.card.create');
    }

    public function destroy($card_id)
    {
        \DB::transaction(function () use ($card_id) {
            $customer_id = $this->payment_service->getCustomer();
            $this->payment_service->destroyCard($customer_id, $card_id);

        \Session::put('flash_msg','クレジットカード情報を削除しました！');

        });
        return redirect()->route('member_config.card.create');
    }
}
