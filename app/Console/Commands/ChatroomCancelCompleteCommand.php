<?php

namespace App\Console\Commands;

use App\Models\Chatroom;
use App\Services\ChatroomMessageService;
use App\Services\ChatroomService;
use App\Services\CouponService;
use App\Services\EvaluationService;
use App\Services\PointService;
use App\Services\PurchasedCancelService;
use App\Services\UserNotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChatroomCancelCompleteCommand extends Command
{
    private $chatroom_service;
    private $purchased_cancel_service;
    private $coupon_service;
    private $user_use_point_service;
    private $evaluation_service;
    private $chatroom_message_service;
    private $user_notification_service;

    public function __construct(
        ChatroomService $chatroom_service,
        PurchasedCancelService $purchased_cancel_service,
        CouponService $coupon_service,
        PointService $user_use_point_service,
        EvaluationService $evaluation_service,
        ChatroomMessageService $chatroom_message_service,
        UserNotificationService $user_notification_service
    )
    {
        parent::__construct();
        $this->chatroom_service = $chatroom_service;
        $this->purchased_cancel_service = $purchased_cancel_service;
        $this->coupon_service = $coupon_service;
        $this->user_use_point_service = $user_use_point_service;
        $this->evaluation_service = $evaluation_service;
        $this->chatroom_message_service = $chatroom_message_service;
        $this->user_notification_service = $user_notification_service;
    }


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ChatroomCancelCompleteCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'キャンセルが成立された後、72時間以内に評価の未入力場合に評価済み（普通）にする';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // キャンセル報告がある場合、72時間が経過すると自動的に承認となります
        $chatrooms = Chatroom::where(function ($query) {
            $query->where('status', Chatroom::STATUS_WORK)
                ->orwhere('status', Chatroom::STATUS_CANCELED_REPORT);
        })->where('updated_at', '<=', Carbon::now()->subHours(72))
            ->get();

        // 処理の実行
        foreach ($chatrooms as $chatroom) {
            $this->processApproveCancelReport($chatroom);
        }

        // キャンセルが成立された後、72時間以内に評価の未入力のChatroomのレコードを取得
        $chatrooms = Chatroom::where(function ($query) {
            $query->where('status', Chatroom::STATUS_CANCELED)
                ->orwhere('status', Chatroom::STATUS_CANCEL_SENDER_EVALUATION);
        })->where('updated_at', '<=', Carbon::now()->subHours(72))
            ->get();

        // 処理の実行
        foreach ($chatrooms as $chatroom) {
            if ($chatroom->status === Chatroom::STATUS_CANCELED) {
                $this->processSenderEvaluation($chatroom);
            } else if ($chatroom->status === Chatroom::STATUS_CANCEL_SENDER_EVALUATION) {
                $this->processReceiverEvaluation($chatroom);
            }
        }
    }

    /**
     * キャンセル申請承認通知
     *
     * @param Chatroom $chatroom
     * @return void
     */
    private function processApproveCancelReport(Chatroom $chatroom)
    {
        if ($chatroom->purchase()->exists()) {
            $purchased_cancel = $this->purchased_cancel_service->getPurchasedCancelByPurchaseId($chatroom->purchase->id);
            if ($purchased_cancel && $purchased_cancel->purchase()->exists()) {
                DB::transaction(function () use ($chatroom, $purchased_cancel) {
                    $this->coupon_service->cancelCoupon($purchased_cancel->purchase->userCoupon);
                    $this->user_use_point_service->cancelPoint($purchased_cancel->purchase->userUsePoint);
                    $payment = $purchased_cancel->purchase->payment;
                    $sender_user_id = $this->chatroom_service->getSenderUserId($chatroom);
                    $target_user_id = $sender_user_id;
                    if ($sender_user_id == $chatroom->buyer_user_id) {
                        $target_user_id = $chatroom->seller_user_id;
                    }
                    $this->purchased_cancel_service->purchasedCancelComplete($purchased_cancel, $payment, $target_user_id);
                    $this->user_notification_service->storeUserNotificationMessage($purchased_cancel->purchase->chatroom);
                });
            }
        }
    }

    /**
     * 評価処理
     *
     * @param Chatroom $chatroom
     * @return void
     */
    private function processSenderEvaluation(Chatroom $chatroom)
    {
        DB::transaction(function () use ($chatroom) {
            $request = [
                'star' => 2.5,
                'text' => ''
            ];
            $sender_user_id = $this->chatroom_service->getSenderUserId($chatroom);
            $evaluation = $this->evaluation_service->storeSenderEvaluationByCommand($request, $chatroom, $sender_user_id);
            $this->chatroom_message_service->storeEvaluationMessageByCommand($evaluation, $chatroom);
            $this->chatroom_service->statusChangeCancelSender($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });
    }

    /**
     * 評価処理
     *
     * @param Chatroom $chatroom
     * @return void
     */
    private function processReceiverEvaluation(Chatroom $chatroom)
    {
        DB::transaction(function () use ($chatroom) {
            $request = [
                'star' => 2.5,
                'text' => ''
            ];
            $sender_user_id = $this->chatroom_service->getSenderUserId($chatroom);
            $evaluation = $this->evaluation_service->storeReceiverEvaluationByCommand($request, $chatroom, $sender_user_id);
            $this->chatroom_message_service->storeEvaluationMessageByCommand($evaluation, $chatroom);
            $this->chatroom_service->statusChangeCancelReceiver($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });
    }
}
