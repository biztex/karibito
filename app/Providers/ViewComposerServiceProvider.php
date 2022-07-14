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
        \View::composer('*', function ($view) {
            $view->with('user_profile', UserProfile::firstWhere('user_id',\Auth::id()))
                ->with('prefectures', Prefecture::all())
                ->with('categories', MProductCategory::all())
                // ->with('user_notifications', UserNotification::all())
                ->with('not_view_user_notifications', UserNotification::latest()->where([['is_view', 0], ['user_id', \Auth::id()]])->take(5)->get()); //未読のものだけ取得
        });
    }
}
