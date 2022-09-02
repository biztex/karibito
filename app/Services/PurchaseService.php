<?php

namespace App\Services;

use App\Models\Proposal;
use App\Models\Purchase;
use App\Models\Payment;
use App\Models\MCommissionRate;
use App\Services\CouponService;

class PurchaseService
{
    private $coupon_service;

    public function __construct(CouponService $coupon_service)
    {
        $this->coupon_service = $coupon_service;
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

    public function isCancel(Purchase $purchase)
    {
        $purchase->fill([
            'is_cancel' => Purchase::IS_CANCEL,
            'cancel_date' => \Carbon\Carbon::now()    
            ])->save();
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