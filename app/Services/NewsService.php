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
        $columns = ['title', 'content', 'is_important'];

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

    public function paginate($i)
    {
        $news_list = News::latest()->paginate($i);

        return $news_list;
    }
}
