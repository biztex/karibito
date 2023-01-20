<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;

class AlreadyReadController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(UserNotification $user_notification)
    {
        $user_notification->is_view = 1;
        $user_notification->save();
        $object = $user_notification->reference;
        $portfolio_user_id = $user_notification->reference->user_id;

        if ($user_notification->reference_type === 'App\Models\Product') {
            return redirect()->route('product.show', ['product' => $object]);
        } elseif($user_notification->reference_type === 'App\Models\JobRequest') {
            return redirect()->route('job_request.show', ['job_request' => $object]);
        } elseif($user_notification->reference_type === 'App\Models\Portfolio') {
            return redirect()->route('user.portfolio.show', ['portfolio' => $object, 'user' => $portfolio_user_id]);
        } elseif($user_notification->reference_type === 'App\Models\Chatroom') {
            return redirect()->route('chatroom.show', ['chatroom' => $object]);
        } elseif($user_notification->reference_type === 'App\Models\Dmroom') {
            return redirect()->route('dm.show', ['dmroom' => $object]);
        } elseif($user_notification->reference_type === 'App\Models\UserProfile') {
            return redirect()->route('setting.index');
        } else{
            return view('mypage.user_notification.show', compact('user_notification'));
        }
    }
}
