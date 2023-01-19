<?php

namespace App\Services;

use App\Jobs\SendNewDmNotificationMail;
use App\Models\UserNotification;
use App\Models\User;

use App\Jobs\SendNewFavoriteNotificationMail;
use App\Jobs\SendNewLikeNotificationMail;
use App\Jobs\SendNewNewsNotificationMail;
use App\Jobs\SendNewPostNotificationMail;
use App\Mail\MessageRegisterMail;
use App\Mail\DmRegisterMail;
use App\Mail\LikeRegisterMail;
use App\Models\Chatroom;
use App\Models\Dmroom;
use App\Models\News;
use App\Models\UserFollow;
use App\Models\DmroomMessage;
use App\Models\Product;
use App\Models\JobRequest;
use App\Jobs\SendNewMessageNotificationMail; 
use App\Models\Favorite;

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
                'title' => 'あなたがフォローしている ' . $followed_user->name . 'さんが新しい投稿をしました。確認してみましょう。',
            ];

            if(empty($follow_user->userNotificationSetting->is_posting)) {
                $user_notification_contents['is_notification'] = 0;
            } else {
                $user_notification_contents['is_notification'] = 1;
            }

            $user_notification = $product->userNotifications()->create($user_notification_contents);
            SendNewPostNotificationMail::dispatch($user_notification);

            return $followed_user;
        };
    }

    // お気に入りしている商品が更新されたら通知する
    public function storeUserNotificationFavorite($product)
    {
        $favorite_users = $product->favorites;

        foreach ($favorite_users as $favorite_user) {
            $user_notification_contents = [
                'user_id' => $favorite_user->user_id,
                'title' => 'あなたがいいねした ' . $product->title . 'が更新されました。確認してみましょう。',
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

        $user_notification = new UserNotification();

        if($product instanceof Product){
            $reference_type = 'App\Models\Product';
        } elseif ($product instanceof JobRequest){
            $reference_type = 'App\Models\JobRequest';
        } 

        // ※注意・・・UserNotificationのタイトルに含まれる「いいねした人の名前」と「いいね」という文言から過去のいいねを取得しています。
        // そのためタイトルの文言が変更されるとこの変数も修正が必要。
        $pase_like_notification = UserNotification::where('reference_id', $product->id)
        ->where('user_id', $product_user->id)
        ->where('title', 'like', '%' . $login_user->name . '%')
        ->where('title', 'like', "%いいね%")
        ->get();

        $user_notification = [
            'user_id' => $product_user->id,
            'title' => $login_user->name . 'さんからいいねが来ました。',
            'reference_type' => $reference_type,
            'reference_id' => $product->id,
        ];

        if(empty($product_user->userNotificationSetting->is_like)) {
            $user_notification['is_notification'] = 0;
        } else {
            $user_notification['is_notification'] = 1;
        }

        $mail_content = UserNotification::create($user_notification);
        
        // 過去に「いいね」が一度もされていなかった場合のみメール送信
        if ($pase_like_notification->isEmpty()) {
            SendNewLikeNotificationMail::dispatch($product_user, $mail_content);
        }
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
        
        // やりとりの進捗に合わせてメッセージタイトルを分ける
        if($chatroom->status === 5) {
            $title = $send_user->name . 'さんがあなたを評価しました。';
        } elseif ($chatroom->status === 6) {
            $title = $send_user->name . 'さんがあなたを評価しました。これで取引完了です。';
        } else {
            $title = $send_user->name . 'さんからメッセージが届きました。';
        }
        
        $user_notification_contents = [
            'user_id' => $receive_user->id,
            'title' => $title,
        ];
        if(empty($receive_user->userNotificationSetting->is_message)) {
            $user_notification_contents['is_notification'] = 0;
        } else {
            $user_notification_contents['is_notification'] = 1;
        }

        $user_notification = $chatroom->userNotifications()->create($user_notification_contents);

        SendNewMessageNotificationMail::dispatch($receive_user,$user_notification); 
    }
    
    //DMが来たら通知する
    public function storeUserNotificationDm($dmroom_message)
    {    
        $dmroom = $dmroom_message->dmroom;
        $send_user = $dmroom_message->user; //送信者
        $receive_user = $dmroom_message->getReceiveUser($dmroom_message); //受信者
        
        $user_notification_contents = [
            'user_id' => $receive_user->id,
            'title' => $send_user->name . 'さんからメッセージが届きました。',
        ];
        if(empty($receive_user->userNotificationSetting->is_message)) {
            $user_notification_contents['is_notification'] = 0;
        } else {
            $user_notification_contents['is_notification'] = 1;
        }
        
        $user_notification = $dmroom->userNotifications()->create($user_notification_contents);
        
        SendNewDmNotificationMail::dispatch($receive_user,$user_notification);
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

    // 会員情報の身分証明書承認キャンセル通知
    public function storeUserNotificationCancelIdentify($user_profile)
    {
        $user_notification = [
            'user_id' => $user_profile->user_id,
            'reference_type' => 'App\Models\UserProfile',
            'reference_id' => $user_profile->id,
            'title' => '本人確認申請が承認されませんでした。',
            'is_notification' => 0
        ];

        UserNotification::create($user_notification);
    }
}