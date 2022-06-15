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
            $job_request->is_draft = JobRequest::NOT_DRAFT;
            $job_request->status = JobRequest::STATUS_PUBLISH;
            $job_request->save();
    
        return $job_request;
    }

    /**
     * リクエスト編集
     */
    public function updateJobRequest(array $params, $job_request):JobRequest
    {
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];

            foreach($columns as $column){
                $job_request->$column = $params[$column];
            }
            $job_request->is_draft = JobRequest::NOT_DRAFT;
            $job_request->status = JobRequest::STATUS_PUBLISH;
            $job_request->save();
        return $job_request;
    }

    /**
     * 新規リクエスト下書き保存
     */
    public function storeDraftJobRequest(array $params):JobRequest
    {
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];

            $job_request = new JobRequest;
            $job_request->user_id = \Auth::id();
            foreach($columns as $column){
                $job_request->$column = $params[$column];
            }
            $job_request->is_draft = JobRequest::IS_DRAFT;
            $job_request->status = JobRequest::STATUS_PRIVATE;
            $job_request->save();
    
        return $job_request;
    }

    /**
     * 編集画面よりジョブリクエスト下書き保存
     */
    public function updateDraftJobRequest(array $params, $job_request):JobRequest
    {
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];

            foreach($columns as $column){
                $job_request->$column = $params[$column];
            }
            $job_request->is_draft = JobRequest::IS_DRAFT;
            $job_request->status = JobRequest::STATUS_PRIVATE;
            $job_request->save();

        return $job_request;
    }

}