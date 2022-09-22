<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Chatroom;
use App\Models\JobRequest;
use App\Models\PurchasedJobRequest;


class PurcahsedJobRequestService
{
    public function storePurchasedJobRequest(Chatroom $chatroom)
    {
        $job_request = $chatroom->reference;
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];

        $purchased_product = new PurchasedJobRequest;
        $purchased_product->user_id = $job_request->user_id;

        foreach($columns as $column){
            $purchased_product->$column = $job_request[$column];
        }
        $purchased_product->is_draft = JobRequest::NOT_DRAFT;
        $purchased_product->status = JobRequest::STATUS_PUBLISH;
        $purchased_product->save();

        $chatroom->purchased_reference_id = $purchased_product->id;
        $chatroom->purchased_reference_type = 'App\Models\PurchasedJobRequest';
        $chatroom->save();
    }

    // /**
    //  * 新規リクエスト投稿
    //  */
    // public function storeJobRequest(array $params): JobRequest
    // {
    //     $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];

    //         $job_request = new JobRequest();
    //         $job_request->user_id = \Auth::id();
    //         foreach($columns as $column){
    //             $job_request->$column = $params[$column];
    //         }
    //         $job_request->is_draft = JobRequest::NOT_DRAFT;
    //         $job_request->status = JobRequest::STATUS_PUBLISH;
    //         $job_request->save();

    //     return $job_request;
    // }
}