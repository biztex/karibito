<?php

namespace App\Services;

use App\Models\JobRequest;

class AdminJobRequestSearchService
{
    /**
     * job_requestの検索
     */
    public function searchJobRequest($request)
    {
        $sql = JobRequest::orderBy('id', 'desc');

        $sql->orWhere('title', 'LIKE', "%$request->search%")
            ->orWhereHas('user', function ($q) use ($request){
                $q->where('name', 'LIKE', "%$request->search%");
        });

        return $sql->paginate(50)->appends($request->query());
    }
}
