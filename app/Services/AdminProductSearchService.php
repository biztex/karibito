<?php

namespace App\Services;

use App\Models\Product;

class AdminProductSearchService
{
    /**
     * お問い合わせ完了メール送信
     */
    public function searchJobRequest($request)
    {
        $sql = Product::orderBy('id');

        $sql->orWhere('title', 'LIKE', "%$request->search%")
            ->orWhereHas('user', function ($q) use ($request){
                $q->where('name', 'LIKE', "%$request->search%");
        });

        return $sql->paginate(50)->appends($request->query());
    }
}
