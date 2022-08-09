<?php

namespace App\Services;

use App\Models\Proposal;
use App\Models\Purchase;
use App\Models\Payment;
use App\Models\MCommissionRate;

class PurchaseService
{
    public function storePurchase(Proposal $proposal, Payment $payment, MCommissionRate $m_commission_rate): Purchase
    {
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

}