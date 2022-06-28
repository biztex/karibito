<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\UserProfile;
use App\Models\Prefecture;
use App\Models\MProductCategory;

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
                ->with('categories', MProductCategory::all());
        });
    }
}
