<?php

namespace App\Services;

class ProposalService
{
    // 提案 proposalテーブル
    public function storeProposal(array $request, $chatroom)
    {
        $proposal = [
            'user_id' => \Auth::id(),
            'price' => $request['price']
        ];
        $proposal = $chatroom->proposal()->create($proposal);
        return $proposal;
    }

    public function purchasedProposal($proposal)
    {
        $proposal->fill(['is_purchase' => 1])->save();
    }
}