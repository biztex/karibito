<?php

namespace App\Services;

use  App\Models\Product;
use  App\Models\JobRequest;
use  App\Models\Chatroom;
use  App\Services\ChatroomMessageService;
use  App\Services\ProfitService;
use  App\Services\PurchaseService;


class ChatroomService
{
    private $chatroom_message_service;
    private $profit_service;

    public function __construct(ChatroomMessageService $chatroom_message_service, ProfitService $profit_service)
    {
        $this->chatroom_message_service = $chatroom_message_service;
        $this->profit_service = $profit_service;
    }

    // 新規チャット(提供)
    public function startChatroomProduct(Product $product): Chatroom
    {
        $users = [
            'seller_user_id' => $product->user_id,
            'buyer_user_id' => \Auth::id(),
        ];
        $chatroom = $product->chatrooms()->create($users);

        return $chatroom;
    }
    // 新規チャット(リクエスト)
    public function startChatroomJobRequest(JobRequest $job_request): Chatroom
    {
        $users = [
            'seller_user_id' => \Auth::id(),
            'buyer_user_id' => $job_request->user_id,
        ];
        $chatroom = $job_request->chatrooms()->create($users);

        return $chatroom;
    }

    // ステータスを 2:契約 に変更
    public function statusChangeContract(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => Chatroom::STATUS_PROPOSAL])->save();
    }

    // ステータスを 3:作業 に変更
    public function statusChangeWork(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => Chatroom::STATUS_WORK])->save();
    }

    // ステータスを 4:購入者評価 に変更
    public function statusChangeWorkReport(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => Chatroom::STATUS_WORK_REPORT])->save();
    }

    // ステータスを 4:購入者評価 に変更
    public function statusChangeBuyerEvaluation(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => Chatroom::STATUS_BUYER_EVALUATION])->save();
    }

    // ステータスを 5:出品者評価 に変更
    public function statusChangeSellerEvaluation(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => Chatroom::STATUS_SELLER_EVALUATION])->save();
    }

    // ステータスを 6:完了 に変更 & 売上金レコード作成
    public function statusChangeComplete(Chatroom $chatroom, PurchaseService $purchase_service)
    {
        $chatroom->fill(['status' => Chatroom::STATUS_COMPLETE])->save();
        // 要確認
        if(empty($chatroom->profit)){
            $this->createProfit($chatroom, $purchase_service);
        }
    }

    // ステータスを 7:キャンセル に変更
    public function statusChangeCanceled(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => Chatroom::STATUS_CANCELED])->save();
    }

    // ステータスを 8:キャンセルした側評価に変更
    public function statusChangeCancelSender(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => Chatroom::STATUS_CANCEL_SENDER_EVALUATION])->save();
    }

    // ステータスを 8:キャンセルした側評価に変更
    public function statusChangeCancelReceiver(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION])->save();
    }

    // 売上金レコードの作成
    public function createProfit(Chatroom $chatroom, PurchaseService $purchase_service)
    {
        $commission = $purchase_service->getCommission($chatroom->purchase->proposal);
        $this->profit_service->storeProfit($chatroom->seller_user_id, $chatroom->id, $chatroom->purchase->proposal->price, $commission);
    }

    // 商品が削除されたとき、チャットルームのステータスをキャンセルにし、
    // 商品が削除されましたメッセージを送る
    public function deleteProduct(Product $product)
    {
        foreach($product->chatrooms as $chatroom) {
            if($chatroom->status === Chatroom::STATUS_START || $chatroom->status === Chatroom::STATUS_PROPOSAL ) {
                $this->statusChangeCanceled($chatroom);
                $this->chatroom_message_service->storeDeleteMessage($chatroom);
            }
        }
    }

    public function deleteJobRequest(JobRequest $job_request)
    {
        foreach($job_request->chatrooms as $chatroom) {
            if($chatroom->status === Chatroom::STATUS_START || $chatroom->status === Chatroom::STATUS_PROPOSAL ) {
                $this->statusChangeCanceled($chatroom);
                $this->chatroom_message_service->storeDeleteMessage($chatroom);
            }
        }
    }

    // ユーザーが退会ボタンを押したとき、取引中のやりとりがあれば、
    // 退会できない旨のメッセージを表示
    public function canIWithdraw($user)
    {
        $chatrooms = Chatroom::where('seller_user_id',$user->id)
                    ->orWhere('buyer_user_id',$user->id)
                    ->get();
        $can_i_withdraw = $chatrooms->whereBetween('status',[Chatroom::STATUS_WORK, Chatroom::STATUS_COMPLETE])->isEmpty();

        if(!$can_i_withdraw){
            return redirect()->route('showWithdrawForm')->with('flash_msg','現在取引中のため退会することができません')->throwResponse();
        }
        return true;
    }

    public function updateTrashFlg($trash_flg, $chatroom_id): void
    {
        $chatroom = Chatroom::findOrFail($chatroom_id);
        $chatroom->fill(['trash_flg' => $trash_flg])->save();
    }

}
