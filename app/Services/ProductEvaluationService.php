<?php

namespace App\Services;
use App\Models\ProductEvaluation;


class ProductEvaluationService
{
    // 評価 product evaluationsテーブル
    public function storeProductEvaluation(array $request, $product_chatroom)
    {
        if($product_chatroom->buyer_user_id === \Auth::id()){
            $target_user_id = $product_chatroom->seller_user_id;
        }else{
            $target_user_id = $product_chatroom->buyer_user_id;
        }

        $evaluation = [
            'user_id' => \Auth::id(),
            'target_user_id' => $target_user_id,
            'star' => $request['star'],
            'text' => $request['text']
        ];
        $product_evaluation = $product_chatroom->productEvaluation()->create($evaluation);
        return $product_evaluation;
    }
}