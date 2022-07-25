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

        if(isset($request['reason1'])){ $purchased_cancel->reason1 = 1; }
        if(isset($request['reason2'])){ $purchased_cancel->reason2 = 1; }
        if(isset($request['reason3'])){ $purchased_cancel->reason3 = 1; }
        if(isset($request['reason4'])){ $purchased_cancel->reason4 = 1; }
        if(isset($request['reason5'])){ $purchased_cancel->reason5 = 1; }
        if(isset($request['reason6'])){ $purchased_cancel->reason6 = 1; }

        $purchased_cancel->text = $request['text'];
        $purchased_cancel->save();

        return $purchased_cancel;
    }

    public function changeStatusComplete(PurchasedCancel $purchased_cancel)
    {
        $purchased_cancel->fill([
            'status' => PurchasedCancel::STATUS_CANCELED,
            'cancel_date' => now()            
            ])->save();
    }

    public function changeStatusObjection(PurchasedCancel $purchased_cancel)
    {
        $purchased_cancel->fill(['status' => PurchasedCancel::STATUS_OBJECTION])->save();
    }
}