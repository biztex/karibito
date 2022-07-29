<?php

namespace App\Services;

use App\Models\Proposal;
use App\Models\Purchase;

class PurchaseService
{
    public function storePurchase(Proposal $proposal)
    {
        $chatroom = $proposal->chatroom;
        $column = [
            'proposal_id' => $proposal->id,
            'buyer_user_id' => \Auth::id(),
        ];
        $purchase = $chatroom->purchase()->create($column);
        return $purchase;
    }

    public function isCancel(Purchase $purchase)
    {
        $purchase->fill([
            'is_cancel' => Purchase::IS_CANCEL,
            'cancel_date' => now()    
            ])->save();
    }

}