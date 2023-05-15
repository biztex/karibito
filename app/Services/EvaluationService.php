<?php

namespace App\Services;

use App\Models\Evaluation;
use App\Models\Product;

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

    // 評価 evaluationsテーブル
    public function storeSenderEvaluationByCommand(array $request, $chatroom, $cancel_sender_user_id)
    {
        $user_id = null;
        if($chatroom->buyer_user_id === $cancel_sender_user_id){
            $user_id = $chatroom->seller_user_id;
        }else{
            $user_id = $chatroom->buyer_user_id;
        }

        $evaluation = [
            'user_id' => $user_id,
            'target_user_id' => $cancel_sender_user_id,
            'star' => $request['star'],
            'text' => $request['text']
        ];
        $evaluation = $chatroom->evaluations()->create($evaluation);
        return $evaluation;
    }

    // 評価 evaluationsテーブル
    public function storeReceiverEvaluationByCommand(array $request, $chatroom, $cancel_sender_user_id)
    {
        $target_user_id = null;
        if($chatroom->buyer_user_id === $cancel_sender_user_id){
            $target_user_id = $chatroom->seller_user_id;
        }else{
            $target_user_id = $chatroom->buyer_user_id;
        }

        $evaluation = [
            'user_id' => $cancel_sender_user_id,
            'target_user_id' => $target_user_id,
            'star' => $request['star'],
            'text' => $request['text']
        ];
        $evaluation = $chatroom->evaluations()->create($evaluation);
        return $evaluation;
    }

    public function getEvaluations($user_id)
    {
        $evaluations['good'] = Evaluation::goodStar($user_id)->orderBy('created_at','desc')->paginate(10);
        $evaluations['pity'] = Evaluation::pityStar($user_id)->orderBy('created_at','desc')->paginate(10);
        $evaluations['usually'] = Evaluation::usuallyStar($user_id)->orderBy('created_at','desc')->paginate(10);

        return $evaluations;
    }

    public function countEvaluations($user_id)
    {
        $counts['good'] = Evaluation::goodStar($user_id)->count();
        $counts['pity'] = Evaluation::pityStar($user_id)->count();
        $counts['usually']  = Evaluation::usuallyStar($user_id)->count();

        return $counts;
    }

    public function getProductEvaluations(Product $product): array
    {
        $evaluations = [];
        foreach($product->chatrooms as $chatroom){
            if($chatroom->evaluations->isNotEmpty()){
                foreach($chatroom->evaluations as $evaluation){
                    if($evaluation->target_user_id === $product->user_id){
                        array_push($evaluations, $evaluation);
                    }
                }
            };   
        }
        return $evaluations;
    }
}