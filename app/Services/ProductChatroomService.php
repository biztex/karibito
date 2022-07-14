<?php

namespace App\Services;
use App\Models\ProductProposal;


class ProductChatroomService
{
    // 新規チャット
    public function startProductChatroom($product)
    {
        $users = [
            'seller_user_id' => $product->user_id,
            'buyer_user_id' => \Auth::id(),
        ];
        $product_chatroom = $product->productChatroom()->create($users);
        
        return $product_chatroom;
    }

    // 通常メッセージ
    public function storeProductChatroomMessage(array $request, $product_chatroom)
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

        $product_chatroom->productChatroomMessage()->create($message);
    }

    // 提案 product chatroom message テーブル
    public function storeProductProposalMessage($product_proposal, $product_chatroom)
    {
        $message = [
            'product_chatroom_id' => $product_chatroom->id,
            'user_id' => \Auth::id(),
        ];
        $product_proposal->productChatroomMessage()->create($message);
    }

    // 作業完了報告
    public function storeProductCompleteMessage($product_chatroom)
    {
        $message = [
            'user_id' => \Auth::id(),
            'is_complete_message' => 1,
        ];
        $product_chatroom->productChatroomMessage()->create($message);
    }

    // 評価
    public function storeProductEvaluationMessage($product_evaluation, $product_chatroom)
    {
        $message = [
            'product_chatroom_id' => $product_chatroom->id,
            'user_id' => \Auth::id(),
        ];
        $product_evaluation->productChatroomMessage()->create($message);
    }

    // ステータスを 2:契約 に変更
    public function statusChangeContract($product_chatroom)
    {
        $product_chatroom->fill(['status' => 2])->save();
    }

    // ステータスを 3:作業 に変更
    public function statusChangeWork($product_proposal)
    {
        $product_proposal->productChatroom->fill(['status' => 3])->save();
    }

    // ステータスを 4:購入者評価 に変更
    public function statusChangeBuyerEvaluation($product_chatroom)
    {
        $product_chatroom->fill(['status' => 4])->save();
    }

    // ステータスを 5:出品者評価 に変更
    public function statusChangeSellerEvaluation($product_chatroom)
    {
        $product_chatroom->fill(['status' => 5])->save();
    }

    // ステータスを 6:完了 に変更
    public function statusChangeComplete($product_chatroom)
    {
        $product_chatroom->fill(['status' => 6])->save();
    }

}