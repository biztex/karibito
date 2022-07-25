<?php

namespace App\Services;

use App\Models\JobRequest;
use App\Http\Requests\JobRequest\StoreRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Libraries\DiffDateTime;


class JobRequestService
{
    /**
     * 新規リクエスト投稿
     */
    public function storeJobRequest(array $params): JobRequest
    {
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];

            $job_request = new JobRequest();
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
    public function updateJobRequest(array $params, $job_request): JobRequest
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
    public function storeDraftJobRequest(array $params): JobRequest
    {
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];

            $job_request = new JobRequest();
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
    public function updateDraftJobRequest(array $params, $job_request): JobRequest
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

    public function searchJobRequests(object $request)
    {
        $prefecture_id = $request->prefecture_id;
        $low_price = $request->low_price;
        $high_price = $request->high_price;
        $is_online = $request->is_online;
        $age_period = $request->age_period;
        $sort = $request->sort;
        $keyword = $request->keyword;


        $query = JobRequest::publish();
        if ($keyword) {
            $query->where(function(Builder $query) use($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%");
            });
        }


        if (!is_null($age_period)) {
            $now_year = date('Y');
            $year = $now_year - 9;
            $year -= $age_period * 10;
            $up_year = $year + 10;

            if ($age_period == 1) {
                $query->whereHas('user.userProfile', function (Builder $query) use($year){
                    $query->whereYear('birthday', '>', $year);
                }); //見直す
            }
            elseif($age_period == 7)
            {
                $query->whereHas('user.userProfile', function (Builder $query) use($up_year){
                    $query->whereYear('birthday', '<=', $up_year);
                });
            } else {
                $query->whereHas('user.userProfile', function (Builder $query) use($year, $up_year){
                    $query->whereYear('birthday', '>', $year);
                    $query->whereYear('birthday', '<', $up_year);
                });
            }
        }

        if(isset($request->parent_category_flg)) { //子カテゴリ、または親カテゴリから検索した場合
            if($request->parent_category_flg === '1') {
                $category_id = $request->parent_category_id; //商品の子カテゴリに、親カテゴリが当てはめられる
            } elseif($request->parent_category_flg === '0') {
                $category_id = $request->child_category_id;
            }
            $query->where('category_id', $category_id);
        }

        if (!empty($prefecture_id)) {
            $query->where('prefecture_id', $prefecture_id);
        }

        if (!empty($low_price)) {
            $query->where('price', '>=', $low_price);
        }

        if (!empty($high_price)) {
            $query->where('price', '<=', $high_price);
        }

        if ($is_online === '0') {
            $query->where('is_online', $is_online);
        } elseif ($is_online === '1') {
            $query->where('is_online', $is_online);
        }

        if (!empty($sort)) {
            if ($sort == 1) { //ランキングの高い順
                $query->orderBy('created_at','desc'); //とりあえず新着で入れています。
            } elseif ($sort == 2) { //お気に入りの多い順
                $query->orderBy('created_at','desc'); //とりあえず新着で入れています。
            } elseif ($sort == 3) { //新着順
                $query->orderBy('created_at','desc');
            }
        } else {
            $query->latest();
        }

        return $query->paginate(40);
    }

    public function getDiffDateTime()
    {
        $job_request = JobRequest::publish()->orderBy('created_at','desc')->paginate(10);
        $day1 = now();
        $day2 = $job_request['application_deadline'];
        $diff_date_time = DiffDateTime::diff_date_time($day1, $day2);

        return $diff_date_time;
    }

}