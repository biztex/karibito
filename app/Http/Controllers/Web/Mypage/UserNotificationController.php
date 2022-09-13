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

        foreach($user_notifications as $k => $user_notification) {
            if($user_notification->reference_type === 'App\Models\Portfolio') {
                $portfolio_user_id[$k] = $user_notification->reference->user_id;
            }
        }
        if(isset($portfolio_user_id)) {
            return view('mypage.user_notification.index', compact('user_notifications', 'portfolio_user_id'));
        }
        return view('mypage.user_notification.index', compact('user_notifications'));
    }

    public function show(UserNotification $user_notification)
    {
        $user_notification->is_view = 1;
        $user_notification->save();

        return view('mypage.user_notification.show', compact('user_notification'));
    }
}
