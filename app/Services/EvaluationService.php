<?php

namespace App\Services;


class EvaluationService
{
    // 評価 evaluationsテーブル
    public function storeEvaluation(array $request, $chatroom)
    {
        if($chatroom->buyer_user_id === \Auth::id()){
            $target_user_id = $chatroom->seller_user_id;
        }else{
            $target_user_id = $chatroom->buyer_user_id;
        }

        $evaluation = [
            'user_id' => \Auth::id(),
            'target_user_id' => $target_user_id,
            'star' => $request['star'],
            'text' => $request['text']
        ];
        $evaluation = $chatroom->evaluations()->create($evaluation);
        return $evaluation;
    }
}