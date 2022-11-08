<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Favorite;
use App\Models\JobRequest;

class FavoriteService
{
    // 退会した人がいいねしたレコードは消さない。
    // 退会した人の商品を他人がいいねしたレコードを消す。= 退会した人のreference_idのレコードを消す。
    public function deleteFavorites($user)
    {
        $productIds = Product::where('user_id',$user->id)->select('id')->get();
        $jobRequestIds = JobRequest::where('user_id',$user->id)->select('id')->get();
        foreach($productIds as $productId){
            Favorite::where('reference_id',$productId->id)
                    ->where('user_id', '!=', $user->id)
                    ->delete();
        }
        foreach($jobRequestIds as $jobRequestId){
            Favorite::where('reference_id',$jobRequestId->id)
                    ->where('user_id', '!=', $user->id)
                    ->delete();
        }
    }
}
