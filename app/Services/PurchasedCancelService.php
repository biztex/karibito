<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\PurchasedCancel;

class PurchasedCancelService
{
    public function storePurchasedCancel(array $request, Purchase $purchase): PurchasedCancel
    {
        $purchased_cancel = new PurchasedCancel();
        $purchased_cancel->purchase_id = $purchase->id;
        $purchased_cancel->user_id = \Auth::id();

        for($i=1; $i<7; $i++){

            if(isset($request['reason'.$i])){
                $purchased_cancel['reason'.$i] = 1;
            }
        }
        $purchased_cancel->text = $request['text'];
        $purchased_cancel->save();

        return $purchased_cancel;
    }

}