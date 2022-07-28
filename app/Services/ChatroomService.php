<?php

namespace App\Services;

use  App\Models\Product;
use  App\Models\JobRequest;
use  App\Models\Chatroom;


class ChatroomService
{
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

    // ステータスを 6:完了 に変更
    public function statusChangeComplete(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => 6])->save();
    }

    // ステータスを 7:キャンセル に変更
    public function statusChangeCanceled(Chatroom $chatroom)
    {
        $chatroom->fill(['status' => 7])->save();
    }

}