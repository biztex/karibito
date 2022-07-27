<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Product;
use App\Models\JobRequest;
use App\Models\UserNotification;
use App\Models\UserSkill;
use App\Models\UserCareer;
use App\Models\UserJob;
use App\Models\Dmroom;
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

        // パスワード有無(※SNS認証で登録した場合)
        Gate::define('exist.password', function (User $user) {
            return $user->password !== null;
        });

        // 本人確認認証済チェック
        Gate::define('identify', function (User $user) {
            if($user->userProfile !== null){
                return $user->userProfile->is_identify == UserProfile::IS_IDENTIFY;
            }
        });

        // 自分の提供商品
        Gate::define('my.product', function (User $user, Product $product) {
            return $user->id === $product->user_id;
        });

        // 自分のリクエスト
        Gate::define('my.job.request', function (User $user, JobRequest $job_request) {
            return $user->id === $job_request->user_id;
        });

        // 自分へのお知らせ
        Gate::define('my.user.notification', function (User $user, UserNotification $user_notification) {
            return $user->id === $user_notification->user_id;
        });

        // 自分のスキル
        Gate::define('my.skill', function (User $user, UserSkill $user_skill) {
            return $user->id ===  $user_skill->user_id;
        });

        // 自分の経歴
        Gate::define('my.career', function (User $user, UserCareer $user_career) {
            return $user->id ===  $user_career->user_id;
        });

        // 自分の職務
        Gate::define('my.job', function (User $user, Userjob $user_job) {
            return $user->id ===  $user_job->user_id;
        });

        // DM一覧・自分のDM
        Gate::define('my.dm', function (User $user, Dmroom $dmroom) {
            return $user->id === $dmroom->from_user_id || $user->id === $dmroom->to_user_id ;
        });

        // dm/create 自分のdmroomを作らせない
        Gate::define('not.create.dm', function (User $user, $to_user) {
            return $user->id !== $to_user->id;
        });
    }
}
