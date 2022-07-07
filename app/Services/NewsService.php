<?php

namespace App\Services;

use App\Models\News;

class NewsService
{
    /**
     * お問い合わせ完了メール送信
     */
    public function storeNews(array $params): News
    {
        $columns = ['title', 'content'];

        $news = new News;
        foreach($columns as $column){
            $news->$column = $params[$column];
        }
        $news->save();

        return $news;
    }
}
