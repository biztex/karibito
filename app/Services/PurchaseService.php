<?php

namespace App\Services;

use App\Models\Proposal;

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

}