<?php

namespace App\Services;

use App\Models\News;

class NewsService
{
    /**
     * ニュースを登録
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

    public function updateNews(array $params, $news):News
    {
        $columns = ['title', 'content'];

        foreach($columns as $column){
            $news->$column = $params[$column];
        }
        $news->save();
        return $news;
    }
}
