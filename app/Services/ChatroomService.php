<?php

namespace App\Services;

use  App\Models\Product;
use  App\Models\JobRequest;
use  App\Models\Chatroom;
use  App\Services\ChatroomMessageService;
use  App\Services\ProfitService;


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
        $chatroom->fill(['status' => 2])->save();
    }

    // ステータスを 3:作業 に変更
    public function statusChangeWork(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => 3])->save();
    }

    // ステータスを 4:購入者評価 に変更
    public function statusChangeBuyerEvaluation(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => 4])->save();
    }

    // ステータスを 5:出品者評価 に変更
    public function statusChangeSellerEvaluation(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => 5])->save();
    }

    // ステータスを 6:完了 に変更 & 売上金レコード作成
    public function statusChangeComplete(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => 6])->save();
        // 要確認
        if(empty($chatroom->profit)){
            $this->profit_service->storeProfit($chatroom->seller_user_id, $chatroom->id, $chatroom->purchase->proposal->price);
        }
    }

    // ステータスを 7:キャンセル に変更
    public function statusChangeCanceled(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => 7])->save();
    }

    // 商品が削除されたとき、チャットルームのステータスをキャンセルにし、
    // 商品が削除されましたメッセージを送る
    public function deleteProduct(Product $product)
    {
        foreach($product->chatrooms as $chatroom) {
            $this->statusChangeCanceled($chatroom);
            $this->chatroom_message_service->storeDeleteMessage($chatroom);
        }
    }
    
    public function deleteJobRequest(JobRequest $job_request)
    {
        foreach($job_request->chatrooms as $chatroom) {
            $this->statusChangeCanceled($chatroom);
            $this->chatroom_message_service->storeDeleteMessage($chatroom);
        }
    }

}