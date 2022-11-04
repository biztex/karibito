<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Favorite;
use App\Models\JobRequest;

class FavoriteService
{
    // Favoriteテーブルから退会者に関係する商品とリクエストを削除する
    public function deleteFavorites($user)
    {
        Favorite::where('user_id',$user->id)->delete();
        $productIds = Product::where('user_id',$user->id)->select('id')->get();
        $jobRequestIds = JobRequest::where('user_id',$user->id)->select('id')->get();
        foreach($productIds as $productId){
            Favorite::where('reference_id',$productId->id)->delete();
        }
        foreach($jobRequestIds as $jobRequestId){
            Favorite::where('reference_id',$jobRequestId->id)->delete();
        }
    }
}
