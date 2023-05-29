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
use App\Models\Chatroom;
use App\Models\Proposal;
use App\Models\Purchase;
use App\Models\PurchasedCancel;
use App\Models\TransferRequest;
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

        // 自分のやりとり
        // 購入者か提供者が自分でないとアクセスできない
        Gate::define('my.chatroom', function (User $user, Chatroom $chatroom) {
            return $user->id === $chatroom->buyer_user_id || $user->id === $chatroom->seller_user_id ;
        });        

        // やり取りでの提案
        Gate::define('proposal', function (User $user, Chatroom $chatroom) {
            return $user->id === $chatroom->seller_user_id && ($chatroom->status === Chatroom::STATUS_START || $chatroom->status === Chatroom::STATUS_PROPOSAL) ;
        });

        // やり取りでの購入
        Gate::define('purchase', function (User $user, Proposal $proposal) {
            return $user->id === $proposal->chatroom->buyer_user_id 
                && $proposal->chatroom->status === Chatroom::STATUS_PROPOSAL 
                && !$proposal->purchase()->exists();
        });

        // やり取りでの購入完了画面
        Gate::define('purchased', function (User $user, Proposal $proposal) {
            return $user->id === $proposal->chatroom->buyer_user_id 
                && $proposal->chatroom->status === Chatroom::STATUS_WORK 
                && $proposal->purchase()->exists();
        });

        // やり取りでの納品完了 通知画面
        Gate::define('confirm', function (User $user, Chatroom $chatroom) {
            return $user->id === $chatroom->buyer_user_id
                && $chatroom->status === Chatroom::STATUS_WORK_REPORT
                && !$chatroom->evaluations()->exists();
        });

        // やり取りでの購入完了画面
        Gate::define('retry', function (User $user, Chatroom $chatroom) {
            return $user->id === $chatroom->buyer_user_id
                && $chatroom->status === Chatroom::STATUS_WORK_REPORT
                && $chatroom->retry_flg !== 1
                && !$chatroom->evaluations()->exists();
        });

        // やり取りでの作業完了
        Gate::define('worked', function (User $user, Chatroom $chatroom) {
            return $user->id === $chatroom->seller_user_id && $chatroom->status === Chatroom::STATUS_WORK ;
        });

        // やりとり購入者評価
        Gate::define('buyer.evaluation', function (User $user, Chatroom $chatroom) {
            return $user->id === $chatroom->buyer_user_id 
                && $chatroom->status === Chatroom::STATUS_BUYER_EVALUATION 
                && !$chatroom->evaluations()->exists();
        });

        // やり取り提供者評価
        Gate::define('seller.evaluation', function (User $user, Chatroom $chatroom) {
            return $user->id === $chatroom->seller_user_id 
                && $chatroom->status === Chatroom::STATUS_SELLER_EVALUATION 
                && $chatroom->evaluations( function($query, $user, $chatroom){
                                                $query->where([
                                                    ['chatroom_id', '=', $chatroom->id],
                                                    ['user_id', '=', $user->id],
                                                ])->exists();
                                            });
        });

        // キャンセルした側評価
        Gate::define('cancel.sender.evaluation', function (User $user, Chatroom $chatroom) {
            return $chatroom->purchase->exists()
                && !$chatroom->purchase->purchasedCancels->where('user_id', $user->id)->where('status', '<>', \App\Models\PurchasedCancel::STATUS_OBJECTION)->isNotEmpty()
                && $chatroom->status === Chatroom::STATUS_CANCELED
                && !$chatroom->evaluations()->exists();
        });

//        // キャンセルされた側評価
        Gate::define('cancel.receiver.evaluation', function (User $user, Chatroom $chatroom) {
            return $chatroom->purchase->exists()
                && $chatroom->purchase->purchasedCancels->where('user_id', $user->id)->where('status', '<>', \App\Models\PurchasedCancel::STATUS_OBJECTION)->isNotEmpty()
                && $chatroom->status === Chatroom::STATUS_CANCEL_SENDER_EVALUATION
                && $chatroom->evaluations()->exists();
        });

        // やり取り評価完了画面
        Gate::define('chatroom.evaluation.complete', function (User $user, Chatroom $chatroom) {
            return ( $user->id === $chatroom->buyer_user_id && ( $chatroom->status === Chatroom::STATUS_SELLER_EVALUATION || $chatroom->status === Chatroom::STATUS_COMPLETE )) 
                || ( $user->id === $chatroom->seller_user_id && $chatroom->status === Chatroom::STATUS_COMPLETE );
        });

        // やり取りキャンセルした評価完了画面
        Gate::define('chatroom.evaluation.cancel.sender.complete', function (User $user, Chatroom $chatroom) {
            return $chatroom->status === Chatroom::STATUS_CANCEL_SENDER_EVALUATION
                && $chatroom->purchase->exists()
                && !$chatroom->purchase->purchasedCancels->where('user_id', $user->id)->where('status', '<>', \App\Models\PurchasedCancel::STATUS_OBJECTION)->isNotEmpty();
        });

        // やり取りキャンセルされた評価完了画面
        Gate::define('chatroom.evaluation.cancel.receiver.complete', function (User $user, Chatroom $chatroom) {
            return $chatroom->status === Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION
                && $chatroom->purchase->exists()
                && $chatroom->purchase->purchasedCancels->where('user_id', $user->id)->where('status', '<>', \App\Models\PurchasedCancel::STATUS_OBJECTION)->isNotEmpty();
        });

        // やり取りキャンセル可能ステータス
        Gate::define('cancelable', function (User $user, Purchase $purchase) {
            return $purchase->chatroom->isCancelable() ;
        });

        // やり取りキャンセル申請完了画面
        Gate::define('cancel.send', function (User $user, PurchasedCancel $purchased_cancel) {
            return $user->id === $purchased_cancel->user_id && $purchased_cancel->status === PurchasedCancel::STATUS_APPLYING;
        });

        // やり取りキャンセル申請中
        Gate::define('cancel.applying', function (User $user, PurchasedCancel $purchased_cancel) {
            return $user->id !== $purchased_cancel->user_id 
                && ($user->id === $purchased_cancel->purchase->chatroom->buyer_user_id || $user->id === $purchased_cancel->purchase->chatroom->seller_user_id) 
                && $purchased_cancel->status === PurchasedCancel::STATUS_APPLYING;
        });

        // やり取りキャンセル成立
        Gate::define('canceled', function (User $user, PurchasedCancel $purchased_cancel) {
            return $user->id !== $purchased_cancel->user_id 
                && ($user->id === $purchased_cancel->purchase->chatroom->buyer_user_id || $user->id === $purchased_cancel->purchase->chatroom->seller_user_id)
                && $purchased_cancel->status === PurchasedCancel::STATUS_CANCELED 
                && $purchased_cancel->purchase->chatroom->status === Chatroom::STATUS_CANCELED;
        });

        // カリビトアンケート
        Gate::define('survey', function (User $user, Chatroom $chatroom) {
            return $user->id === $chatroom->buyer_user_id || $user->id === $chatroom->seller_user_id;
        });

        // 振込申請内訳
        Gate::define('my.transfer_request', function (User $user, TransferRequest $transfer_request) {
            return $user->id === $transfer_request->user_id;
        });
    }
}
