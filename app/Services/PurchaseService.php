<?php

namespace App\Services;

use App\Models\Proposal;
use App\Models\Purchase;
use App\Models\Payment;
use App\Models\MCommissionRate;
use App\Services\ProposalService;
use App\Services\ChatroomService;
use App\Services\ChatroomMessageService;
use App\Services\CouponService;

class PurchaseService
{
    private $chatroom_service;
    private $chatroom_message_service;
    private $proposal_service;
    private $coupon_service;

    public function __construct(ChatroomService $chatroom_service, ChatroomMessageService $chatroom_message_service, ProposalService $proposal_service, CouponService $coupon_service)
    {
        $this->chatroom_service = $chatroom_service;
        $this->chatroom_message_service = $chatroom_message_service;
        $this->proposal_service = $proposal_service;
        $this->coupon_service = $coupon_service;
    }

    /**
     * 購入完了処理
     */
    public function purchased(string $charge_id, int $amount, Proposal $proposal)
    {
        \DB::transaction(function () use ($charge_id, $amount, $proposal) {
            // payment テーブル
            $payment = $this->storePayment($charge_id, $amount);
            // 提案と購入済に
            $this->proposal_service->purchasedProposal($proposal);
            // 購入テーブル
            $purchase = $this->storePurchase($proposal, $payment);
            // 購入メッセージ
            $this->chatroom_message_service->storePurchaseMessage($purchase, $proposal->chatroom);
            // チャットルームを作業に
            $this->chatroom_service->statusChangeWork($proposal->chatroom);
        });
    }

    /**
     * Paymentテーブル作成
     * @param string $charge_id
     * @param int $amount
     * @return Payment $payment
     */
    public function storePayment(string $charge_id, int $amount): Payment
    {
        $column = [
            'stripe_charge_id' => \Crypt::encryptString($charge_id),
            'amount' => $amount,
        ];
        $payment = \Auth::user()->payments()->create($column);

        return $payment;
    }

    public function storePurchase(Proposal $proposal, Payment $payment): Purchase
    {
        $m_commission_rate = MCommissionRate::nowRate();

        $chatroom = $proposal->chatroom;
        $column = [
            'proposal_id' => $proposal->id,
            'buyer_user_id' => \Auth::id(),
            'payment_id' => $payment->id,
            'm_commission_rate_id' => $m_commission_rate->id
        ];
        $purchase = $chatroom->purchase()->create($column);
        return $purchase;
    }

    public function getCommission(Proposal $proposal): int
    {
        $m_commission_rate = MCommissionRate::nowRate(); // 現在の手数料を取得
        $commission = round($proposal->price * $m_commission_rate->rate / 100);

        return $commission;
    }

    /**
     * @param Proposal $proposal
     * @param array $params
     * 
     * @return array $amount
     */
    public function getFinalAmount(Proposal $proposal, array $params): array
    {
        $amount['price'] = $proposal->price;
        $amount['commission'] = $this->getCommission($proposal);
        $amount['coupon_discount'] = $this->coupon_service->getCouponDiscount($params['coupon_number']);
        $amount['use_point'] = $params['user_use_point'];

        $amount['total'] = $amount['price'] + $amount['commission'] - $amount['coupon_discount'] - $amount['use_point'];
        return $amount;
    }


    /**
     * @param Proposal $proposal
     * @param array $params
     * 
     * @return array $amount
     */
    public function getConfirmAmount(Proposal $proposal, array $params): array
    {
        $amount['price'] = $proposal->price;
        $amount['commission'] = $this->getCommission($proposal);

        if(empty($params['coupon_use'])) {
            $amount['coupon_discount'] = 0;
        } else {
            $amount['coupon_discount'] = $this->coupon_service->getCouponDiscount($params['coupon_number']);
        }

        if($params['point_use'] == 0) {
            $amount['use_point'] = 0;
        } else {
            $amount['use_point'] = $params['user_use_point'];
        }

        $amount['total'] = $amount['price'] + $amount['commission'] - $amount['coupon_discount'] - $amount['use_point'];
        return $amount;
    }

}