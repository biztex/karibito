<?php

namespace App\Services;

use App\Models\Chatroom;

class PurchaseService
{
    public function storePurchase(Chatroom $chatroom)
    {
        $column = [
            'proposal_id' => $chatroom->proposal->id,
            'buyer_user_id' => \Auth::id(),
        ];
        $purchase = $chatroom->purchase()->create($column);
        return $purchase;
    }

}