<?php

namespace App\Services;


class ProductChatroomService
{
    /**
     * 新規チャット
     */
    public function startProductChatroom($product)
    {
        $users = [
            'seller_user_id' => $product->user_id,
            'buyer_user_id' => \Auth::id(),
        ];
        $product_chatroom = $product->productChatroom()->create($users);
    }

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

}