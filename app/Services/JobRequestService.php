<?php
namespace App\Services;

use App\Models\JobRequest;
use App\Http\Requests\JobRequest\StoreRequest;

class JobRequestService
{

    /**
     * 新規リクエスト投稿
     */
    public function storeJobRequest(array $params):JobRequest
    {
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];

            $job_request = new JobRequest;
            $job_request->user_id = \Auth::id();
            foreach($columns as $column){
                $job_request->$column = $params[$column];
            }
            $job_request->is_draft = 1;
            $job_request->status = 1;
            $job_request->save();
    
        return $job_request;
    }
}