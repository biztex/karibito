<?php

namespace App\Services;

use App\Models\UserNotification;

class UserNotificationService
{

    public function paginate($i)
    {
        $user_id = \Auth::id();
        $user_notifications = UserNotification::latest()->where('user_id', $user_id)->paginate($i);

        return $user_notifications;
    }
}
