<?php

namespace App\Services;

use App\Models\UserNotification;
use App\Models\User;

use App\Jobs\SendNewNewsNotificationMail;
use App\Mail\NewsRegisterMail;
use App\Models\Chatroom;

class UserNotificationService
{

    public function paginate($i)
    {
        $user_id = \Auth::id();
        $user_notifications = UserNotification::latest()->where('user_id', $user_id)->paginate($i);

        return $user_notifications;
    }

    // チャットメッセージが来たら通知する
    public function storeUserNotification(array $request, $chatroom_message)
    {
        $receive_user = User::find($chatroom_message->to_user_id); //メッセージを受け取ったユーザー
        $send_user = User::find($chatroom_message->user_id); //メッセージを送ったユーザー

        $user_notification = new UserNotification;
        $user_notification->user_id = $receive_user->id;
        if(empty($receive_user->userNotificationSetting->is_news)) {
            $user_notification->is_notification = 0;
        } else {
            $user_notification->is_notification = 1;
        }

        $user_notification->title = $send_user->name.'さんからメッセージが届きました。';
        // $user_notification->content = $request['text'];内容はチャットの詳細を見るためなしにする・

        $user_notification->save();
        // SendNewNewsNotificationMail::dispatch($user_notification);
    }


    // ニュースのみ全員に送るため例外
    public function storeUserNotificationNews(array $params)
    {
        $users_id = User::where('deleted_at', null)->get('id');

        foreach($users_id as $user_id){
            $user_notification = new UserNotification;
            $user_notification->user_id = $user_id->id;

            if(empty($user_id->userNotificationSetting->is_news)) {
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
}
