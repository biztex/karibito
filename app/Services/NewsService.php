<?php

namespace App\Services;

use App\Jobs\SendNewNewsNotificationMail;
use App\Mail\NewsRegisterMail;
use App\Models\News;
use App\Models\User;
use App\Models\UserNotification;

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

    public function storeUserNotification(array $params)
    {
        $users_id = User::where('deleted_at', null)->get('id');

        foreach($users_id as $user_id){
            $user_notification = new UserNotification;
            $user_notification->user_id = $user_id->id;

            if(empty($user_id->notificationSetting->is_news)) {
                $user_notification->is_notification = 0;
            } else {
                $user_notification->is_notification = 1;
            }
            $user_notification->title = $params['title'];
            $user_notification->content = $params['content'];
            $user_notification->save();
            SendNewNewsNotificationMail::dispatch($user_notification);
        }
    }

    public function paginate($i)
    {
        $news_list = News::latest()->paginate($i);

        return $news_list;
    }
}
