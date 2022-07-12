<?php

namespace App\Services;
use App\Models\ProductProposal;


class ProductProposalService
{
    // 提案 product proposalテーブル
    public function storeProductProposal(array $request, $product_chatroom)
    {
        $proposal = [
            'user_id' => \Auth::id(),
            'price' => $request['price']
        ];
        $product_proposal = $product_chatroom->productProposal()->create($proposal);
        return $product_proposal;
    }

    public function purchesedProductProposal($product_proposal)
    {
        $product_proposal->fill(['is_purchese' => 1])->save();
    }
}