<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use App\Services\UserNotificationService;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    private $user_notification_service;

    public function __construct(UserNotificationService $user_notification_service)
    {
        $this->user_notification_service = $user_notification_service;
    }

    public function index()
    {
        $user_notifications = $this->user_notification_service->paginate(20);

        return view('mypage.user_notification.index', compact('user_notifications'));
    }

    public function show(UserNotification $user_notification)
    {
        // $user_notification->is_view = 1;
        return view('mypage.user_notification.show', compact('user_notification'));
    }
}
