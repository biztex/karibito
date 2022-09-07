<?php

namespace App\Services;

use App\Models\UserNotification;
use App\Models\User;

use App\Jobs\SendNewNewsNotificationMail;
use App\Models\Chatroom;
use App\Models\News;

class UserNotificationService
{

    public function paginate($i)
    {
        $user_id = \Auth::id();
        $user_notifications = UserNotification::latest()->where('user_id', $user_id)->paginate($i);

        return $user_notifications;
    }

    // チャットメッセージが来たら通知する
    public function storeUserNotificationMessage(Chatroom $chatroom)
    {
        $receive_user = User::find($chatroom->to_user_id); //メッセージを受け取ったユーザー

        if($receive_user->id == $chatroom->sellerUser->id)
        {
            $send_user_id = $chatroom->buyerUser->id; //メッセージを送ったユーザーid
        } else {
            $send_user_id = $chatroom->sellerUser->id; //メッセージを送ったユーザーid
        }
        $send_user = User::find($send_user_id);

        $user_notification_contents = [
            'user_id' => $receive_user->id,
            'title' => $send_user->name.'さんからメッセージが届きました。',
        ];
        if(empty($receive_user->userNotificationSetting->is_news)) {
            $user_notification_contents['is_notification'] = 0;
        } else {
            $user_notification_contents['is_notification'] = 1;
        }

        // $user_notification->content = $request['text'];内容はチャットの詳細を見るためなしにする・

        $user_notification = $chatroom->userNotifications()->create($user_notification_contents);
        // SendNewNewsNotificationMail::dispatch($user_notification);;メール処理は一旦飛ばす
    }


    // ニュースのみ全員に送るため例外
    public function storeUserNotificationNews(News $news)
    {
        $users_id = User::where('deleted_at', null)->get('id');

        foreach($users_id as $user_id){
            $user_notification_contents = [
                'user_id' => $user_id->id,
                'title' => $news->title,
                'content' => $news->content,
            ];

            if(empty($user_id->userNotificationSetting->is_news)) {
                $user_notification_contents['is_notification'] = 0;
            } else {
                $user_notification_contents['is_notification'] = 1;
            }

            $user_notification = $news->userNotifications()->create($user_notification_contents);
            SendNewNewsNotificationMail::dispatch($user_notification);
        }
    }

    public function isView(Chatroom $chatroom)
    {
        UserNotification::where([
            ['reference_id', '=', $chatroom->id],
            ['user_id', '=', \Auth::user()->id],
        ])->update(['is_view' => 1]);
    }
}