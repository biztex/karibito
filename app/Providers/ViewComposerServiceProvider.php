<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\UserProfile;
use App\Models\Prefecture;
use App\Models\MProductCategory;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        \View::composer(['components.header'], function ($view) {
            $user_notifications = UserNotification::latest()->where([['is_view', 0], ['user_id', \Auth::id()], ['is_notification', 1]])->take(5)->get(); //通知をオンにしていて、かつ未読のものだけ取得
            $portfolio_user_id = [];
            foreach($user_notifications as $k => $user_notification) {
                if($user_notification->reference_type === 'App\Models\Portfolio') {
                    $portfolio_user_id[$k] = $user_notification->reference->user_id;
                }
            };
            $view->with('categories', MProductCategory::all())
                ->with('not_view_user_notifications', $user_notifications)
                ->with('portfolio_user_id', $portfolio_user_id);
        });
    }
}
