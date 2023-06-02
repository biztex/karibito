<?php

namespace App\Services;

use App\Models\JobRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\MProductChildCategory;
use App\Traits\ProductSearchTrait;

class JobRequestService
{
    use ProductSearchTrait;

    /**
     * 新規リクエスト投稿
     */
    public function storeJobRequest(array $params): JobRequest
    {
        // $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];　電話対応は仕様変更によって一旦非表示
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online'];

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
        // $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];　電話対応は仕様変更によって一旦非表示
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online'];

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
        // $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online'];

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
        // $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online',  'is_call'];
        $columns = ['category_id',  'prefecture_id', 'title', 'content',  'price',  'application_deadline',  'required_date',  'is_online'];

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
        $is_sale = $request->is_sale;
        $sort = $request->sort;
        $keyword = $request->keyword;
        $parent_category_id = $request->parent_category_id;
        $child_category_id = $request->child_category_id;

        $query = JobRequest::display();

        if ($keyword) {
            $query = $this->searchByKeyword($query, $keyword);
        }

        if (!is_null($age_period)) {
            $query = $this->searchByAgePeriod($query, $age_period);
        }

        if(isset($request->parent_category_flg)) { //子カテゴリ、または親カテゴリから検索した場合
            if($request->parent_category_flg === '1') {
                $query = $this->searchByParentCategory($query, $request->parent_category_id);
            } elseif($request->parent_category_flg === '0') {
                $query = $this->searchByChildCategory($query, $request->child_category_id);
            }
        } else { //キーワード検索の時、または検索してから再度検索した時
            if(isset($parent_category_id)) {
                $query = $this->searchByParentCategory($query, $request->parent_category_id);
            } elseif(isset($child_category_id)) {
                $query = $this->searchByChildCategory($query, $request->child_category_id);
            }
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
        } elseif ($is_online === '2') {
            $query->where('is_online', $is_online);
        }

        if ($is_sale === '1') {
            $query->where('application_deadline', '>=', date('Y-m-d'));
        }

        if (!empty($sort)) {
            if ($sort == 1) { //ランキングの高い順
                $query->orderBy('view_count', 'desc');
            } elseif ($sort == 2) { //お気に入りの多い順
                $query->withCount('favorites')->orderBy('favorites_count', 'desc');
            } elseif ($sort == 3) { //新着順
                $query->latest();
            }
        }
        $query->latest();

        return $query->paginate(40);
    }

    public function getURL($id)
    {
        $base_url = config('app.url');
        $url = "$base_url/job_request/$id";

        return $url;
    }

}
