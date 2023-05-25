<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\Payment;
use App\Models\PurchasedCancel;
use App\Services\ChatroomService;
use App\Services\ChatroomMessageService;
use App\Services\PaymentService;

class PurchasedCancelService
{
    private $chatroom_service;
    private $chatroom_message_service;
    private readonly PaymentService $payment_service;

    public function __construct(ChatroomService $chatroom_service, ChatroomMessageService $chatroom_message_service, PaymentService $payment_service)
    {
        $this->chatroom_service = $chatroom_service;
        $this->chatroom_message_service = $chatroom_message_service;
        $this->payment_service = $payment_service;
    }

    public function purchasedCancelComplete(PurchasedCancel $purchased_cancel, Payment $payment, int $target_user_id = null)
    {
        \DB::transaction(function () use ($purchased_cancel, $payment, $target_user_id) {
            // キャンセルテーブルのステータスを成立に
            $this->changeStatusComplete($purchased_cancel);
            // 購入テーブルをキャンセル済に
            $this->isCancel($purchased_cancel->purchase);
            // キャンセル成立メッセージ送信
            $this->chatroom_message_service->storePurchasedCancelApprovalMessage($purchased_cancel, $target_user_id);
            // チャットルームのっステータスをキャンセルに
            $this->chatroom_service->statusChangeCanceled($purchased_cancel->purchase->chatroom);

            // 決済履歴テーブルにキャンセル履歴を
            $this->payment_service->refundPayment($payment);
        });
    }


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
            'cancel_date' => \Carbon\Carbon::now()            
            ])->save();
    }

    public function changeStatusObjection(PurchasedCancel $purchased_cancel)
    {
        $purchased_cancel->fill(['status' => PurchasedCancel::STATUS_OBJECTION])->save();
    }

    public function isCancel(Purchase $purchase)
    {
        $purchase->fill([
            'is_cancel' => Purchase::IS_CANCEL,
            'cancel_date' => \Carbon\Carbon::now()    
            ])->save();
    }

    public function getPurchasedCancelByPurchaseId(int $purchase_id)
    {
        return PurchasedCancel::where('purchase_id', $purchase_id)->first();
    }
}
