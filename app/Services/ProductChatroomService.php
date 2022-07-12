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
        $message = [
            'user_id' => \Auth::id(),
            'text' => $request['text'],
            'file_name' => null,
            'file_path' => null,
        ];
        $product_chatroom->productChatroomMessage()->create($message);
    }

    // 提案 product chatroom message テーブル
    public function storeProductProposalMessage($product_proposal, $product_chatroom)
    {
        $message = [
            'product_chatroom_id' => $product_chatroom->id,
            'user_id' => \Auth::id(),
            'text' => null,
            'file_name' => null,
            'file_path' => null,
        ];
        $product_proposal->productChatroomMessage()->create($message);
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

}