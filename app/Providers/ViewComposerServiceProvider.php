<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\UserProfile;
use App\Models\Prefecture;

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
        \View::composer('*', function($view) {
            $view->with('user_profile', UserProfile::with(['user','prefecture'])->firstWhere('user_id',\Auth::id()))
                 ->with('prefectures' , Prefecture::all());
        });
    }
}
