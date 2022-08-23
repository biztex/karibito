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
            $view->with('categories', MProductCategory::all())
                // ->with('user_notifications', UserNotification::all())
                ->with('not_view_user_notifications', UserNotification::latest()->where([['is_view', 0], ['user_id', \Auth::id()], ['is_notification', 1]])->take(5)->get()); //通知をオンにしていて、かつ未読のものだけ取得
        });
    }
}
