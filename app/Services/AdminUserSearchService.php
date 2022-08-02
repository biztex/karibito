<?php

namespace App\Services;

use App\Models\UserProfile;

class AdminUserSearchService
{
    /**
     * お問い合わせ完了メール送信
     */
    public function searchUser($request)
    {
        $sql = UserProfile::orderBy('id', 'desc');

        $sql->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'LIKE', "%$request->search%");
        });

        if ($request->is_approve) {
            $sql->where('is_identify', UserProfile::NOT_IDENTIFY);
        }

        if ($request->is_ban) {
            $sql->where('is_ban', UserProfile::IS_BAN);
        }

        return $sql->paginate(50)->appends($request->query());
    }
}
