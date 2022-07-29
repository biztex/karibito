<?php

namespace App\Services;

use App\Models\Product;

class AdminProductSearchService
{
    /**
     * productの検索
     */
    public function searchJobRequest($request)
    {
        $sql = Product::orderBy('id', 'desc');

        $sql->orWhere('title', 'LIKE', "%$request->search%")
            ->orWhereHas('user', function ($q) use ($request){
                $q->where('name', 'LIKE', "%$request->search%");
        });

        return $sql->paginate(50)->appends($request->query());
    }
}
