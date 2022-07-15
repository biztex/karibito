<?php

namespace App\Services;

use  App\Models\Product;
use  App\Models\JobRequest;


class ChatroomService
{
    // 新規チャット(提供)
    public function startChatroomProduct(Product $product)
    {
        $users = [
            'seller_user_id' => $product->user_id,
            'buyer_user_id' => \Auth::id(),
        ];
        $chatroom = $product->chatroom()->create($users);
        
        return $chatroom;
    }
    // 新規チャット(リクエスト)
    public function startChatroomJobRequest(JobRequest $job_request)
    {
        $users = [
            'seller_user_id' => \Auth::id(),
            'buyer_user_id' => $job_request->user_id,
        ];
        $chatroom = $job_request->chatroom()->create($users);
        
        return $chatroom;
    }

    // 通常メッセージ
    public function storeChatroomMessage(array $request, $chatroom)
    {
        if(isset($request['file_path'])){
            $message = [
                'user_id' => \Auth::id(),
                'text' => $request['text'],
                'file_name' => $request['file_name'],
                'file_path' => $request['file_path']->store('file_paths','public')];
        } else {
            $message = [
                'user_id' => \Auth::id(),
                'text' => $request['text'],
                'file_name' => $request['file_name'],
            ];
        }

        $chatroom->chatroomMessage()->create($message);
    }

    // 提案 chatroom message テーブル
    public function storeProposalMessage($proposal, $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => '掲載内容の提案をしました',
        ];
        $proposal->chatroomMessage()->create($message);
    }

    // 購入 chatroom message テーブル
    public function storePurchaseMessage($purchase, $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => '商品を購入しました',
        ];
        $purchase->chatroomMessage()->create($message);
    }

    // 作業完了報告
    public function storeCompleteMessage($chatroom)
    {
        $message = [
            'user_id' => \Auth::id(),
            'text' => '作業報告が完了しました',
            'is_complete_message' => 1,
        ];
        $chatroom->chatroomMessage()->create($message);
    }

    // 評価
    public function storeEvaluationMessage($evaluation, $chatroom)
    {
        $message = [
            'chatroom_id' => $chatroom->id,
            'user_id' => \Auth::id(),
            'text' => '評価が完了しました'
        ];
        $evaluation->chatroomMessage()->create($message);
    }

    // ステータスを 2:契約 に変更
    public function statusChangeContract($chatroom)
    {
        $chatroom->fill(['status' => 2])->save();
    }

    // ステータスを 3:作業 に変更
    public function statusChangeWork($proposal)
    {
        $proposal->chatroom->fill(['status' => 3])->save();
    }

    // ステータスを 4:購入者評価 に変更
    public function statusChangeBuyerEvaluation($chatroom)
    {
        $chatroom->fill(['status' => 4])->save();
    }

    // ステータスを 5:出品者評価 に変更
    public function statusChangeSellerEvaluation($chatroom)
    {
        $chatroom->fill(['status' => 5])->save();
    }

    // ステータスを 6:完了 に変更
    public function statusChangeComplete($chatroom)
    {
        $chatroom->fill(['status' => 6])->save();
    }

}