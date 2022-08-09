<?php

namespace App\Services;

use App\Models\Payment;

class AdminPaymentService
{
    /**
     * ユーザー名検索
     */
    public function searchUser($request)
    {
        $sql = Payment::orderBy('id', 'desc');

        $sql->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'LIKE', "%$request->search%");
        });

        return $sql->paginate(50)->appends($request->query());
    }
}