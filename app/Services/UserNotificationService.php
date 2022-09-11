<?php

namespace App\Services;

use App\Models\UserNotification;
use App\Models\User;

use App\Jobs\SendNewFavoriteNotificationMail;
use App\Jobs\SendNewNewsNotificationMail;
use App\Jobs\SendNewLikeNotificationMail;
use App\Jobs\SendNewPostNotificationMail;
use App\Jobs\SendNewMessageNotificationMail;
use App\Models\Chatroom;
use App\Models\News;
use App\Models\UserFollow;

class UserNotificationService
{

    public function paginate($i)
    {
        $user_id = \Auth::id();
        $user_notifications = UserNotification::latest()->where('user_id', $user_id)->paginate($i);

        return $user_notifications;
    }

    // 自分がフォローしているユーザーが商品を投稿したら通知する
    public function storeUserNotificationPost($product)
    {
        $followed_user = User::where('id', $product->user_id)->first(); //フォローされている人が取れる

        $follow_users_id = UserFollow::where('following_user_id', $followed_user->id)->pluck('followed_user_id')->toArray();

        $follow_users = User::where('id', $follow_users_id)->get(); //フォローしているユーザー取得

        foreach ($follow_users as $follow_user) {
            $user_notification_contents = [
                'user_id' => $follow_user->id,
                'title' => 'あなたがフォローしている '.$followed_user->name.'さんが新しい投稿をしました。確認してみましょう。',
                'reference_type' => 'App\Models\UserFollow',
                'reference_id' => $product->id,
            ];

            if(empty($follow_user->userNotificationSetting->is_posting)) {
                $user_notification_contents['is_notification'] = 0;
            } else {
                $user_notification_contents['is_notification'] = 1;
            }

            $user_notification = UserNotification::create($user_notification_contents);
            SendNewPostNotificationMail::dispatch($user_notification);
        };
    }

    // お気に入りしている商品が更新されたら通知する
    public function storeUserNotificationFavorite($product)
    {
        $favorite_users = $product->favorites;

        foreach ($favorite_users as $favorite_user) {
            $user_notification_contents = [
                'user_id' => $favorite_user->user_id,
                'title' => 'あなたがいいねした '.$product->title.'が更新されました。確認してみましょう。',
            ];

            if(empty($favorite_user->user->userNotificationSetting->is_fav)) {
                $user_notification_contents['is_notification'] = 0;
            } else {
                $user_notification_contents['is_notification'] = 1;
            }

            $user_notification = $product->userNotifications()->create($user_notification_contents);
            SendNewFavoriteNotificationMail::dispatch($user_notification);
        };

    }

    // いいねがされたら通知する
    public function storeUserNotificationlike($product)
    {
        $login_user = \Auth::user();
        $product_user = User::find($product->user_id);

        $user_notification = new UserNotification;

        $user_notification = [
            'user_id' => $product_user->id,
            'title' => $login_user->name.'さんからいいねが来ました。',
            'content' => $login_user->name.'さんが'.$product->title.'にいいねをしました。確認してみましょう。', //よう確認
            'reference_type' => 'App\Models\Favorite',
            'reference_id' => $product->id,
        ];

        if(empty($product_user->userNotificationSetting->is_like)) {
            $user_notification['is_notification'] = 0;
        } else {
            $user_notification['is_notification'] = 1;
        }

        $mail_content = UserNotification::create($user_notification);
        SendNewLikeNotificationMail::dispatch($mail_content);
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
        if(empty($receive_user->userNotificationSetting->is_message)) {
            $user_notification_contents['is_notification'] = 0;
        } else {
            $user_notification_contents['is_notification'] = 1;
        }

        $user_notification = $chatroom->userNotifications()->create($user_notification_contents);
        SendNewMessageNotificationMail::dispatch($user_notification);
    }


    // ニュース
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

    // 既読処理
    public function isView($reference_type)
    {
        UserNotification::where([
            ['reference_id', '=', $reference_type->id],
            ['user_id', '=', \Auth::user()->id],
        ])->update(['is_view' => 1]);
    }
}