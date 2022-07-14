<?php

namespace App\Services;

use App\Models\UserNotification;

class UserNotificationService
{

    public function paginate($i)
    {
        $user_notifications = UserNotification::orderBy('created_at','desc')->paginate($i);

        return $user_notifications;
    }
}
