<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Product;
use App\Models\JobRequest;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 本人確認認証済チェック
        Gate::define('identify', function (User $user) {
            return $user->userProfile->is_identify === 1;
        });

        // 自分の提供商品
        Gate::define('my.product', function (User $user, Product $product) {
            return $user->id === $product->user_id;
        });

        // 自分のリクエスト
        Gate::define('my.job.request', function (User $user, JobRequest $job_request) {
            return $user->id === $job_request->user_id;
        });

    }
}
