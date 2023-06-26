<?php

namespace App\Console\Commands;

use App\Models\Chatroom;
use App\Models\MPoint;
use App\Services\ChatroomMessageService;
use App\Services\ChatroomService;
use App\Services\EvaluationService;
use App\Services\PurchaseService;
use App\Services\PointService;
use App\Services\UserNotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Biohazard\LaravelConsoleDebug\Facades\Debug;
use Illuminate\Support\Facades\Log;

class ChatroomDeliveryCompleteCommand extends Command
{
    private $chatroom_service;
    private $evaluation_service;
    private $purchase_service;
    private $point_service;
    private $chatroom_message_service;
    private $user_notification_service;

    public function __construct(
        ChatroomService $chatroom_service,
        EvaluationService $evaluation_service,
        PurchaseService $purchase_service,
        PointService $point_service,
        ChatroomMessageService $chatroom_message_service,
        UserNotificationService $user_notification_service
    )
    {
        parent::__construct();
        $this->chatroom_service = $chatroom_service;
        $this->evaluation_service = $evaluation_service;
        $this->purchase_service = $purchase_service;
        $this->point_service = $point_service;
        $this->chatroom_message_service = $chatroom_message_service;
        $this->user_notification_service = $user_notification_service;
    }


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ChatroomDeliveryCompleteCommand';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('ChatroomDeliveryCompleteCommand実行');
        // 修正箇所がある場合、72時間が経過すると自動的に承認となります
        // $chatrooms = Chatroom::where('status', Chatroom::STATUS_WORK_REPORT)->where('updated_at', '<=', Carbon::now()->subHours(72))->get(); テストのため10分後に変更
        $chatrooms = Chatroom::where('status', Chatroom::STATUS_WORK_REPORT)->where('updated_at', '<=', Carbon::now()->subMinutes(10))->get();

        // 処理の実行
        foreach ($chatrooms as $chatroom) {
            Log::info("processApproveWorkReport実行前｜チャットルームID" . $chatroom->id);
            $this->processApproveWorkReport($chatroom);
            Log::info("processApproveWorkReport実行｜チャットルームID" . $chatroom->id);
        }

        // 納品完了された後、72時間以内に評価の未入力のChatroomのレコードを取得
        $chatrooms = Chatroom::where(function ($query) {
            $query->where('status', Chatroom::STATUS_BUYER_EVALUATION)
                ->orwhere('status', Chatroom::STATUS_SELLER_EVALUATION);
        // })->where('updated_at', '<=', Carbon::now()->subHours(72)) テストのため10分後に変更
        })->where('updated_at', '<=', Carbon::now()->subMinutes(10))
            ->get();

        // 処理の実行
        foreach ($chatrooms as $chatroom) {
            Log::info("受け取り評価処理の実行前｜チャットルームID" . $chatroom->id);
            if ($chatroom->status === Chatroom::STATUS_BUYER_EVALUATION) {
                $this->processBuyerEvaluation($chatroom);
                Log::info("processBuyerEvaluation実行｜チャットルームID" . $chatroom->id);
            } else if ($chatroom->status === Chatroom::STATUS_SELLER_EVALUATION) {
                $this->processSellerEvaluation($chatroom);
                Log::info("processSellerEvaluation実行｜チャットルームID" . $chatroom->id);
            }
        }
        Log::info('コマンドによって評価処理が実行されました。');
    }

    /**
     * 作業完了通知
     *
     * @param Chatroom $chatroom
     * @return void
     */
    private function processApproveWorkReport(Chatroom $chatroom)
    {
        DB::transaction(function () use ($chatroom) {
            $this->chatroom_message_service->storeConfirmMessageByCommand($chatroom);
            $this->chatroom_service->statusChangeBuyerEvaluation($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });
    }

    /**
     * 評価処理
     *
     * @param Chatroom $chatroom
     * @return void
     */
    private function processBuyerEvaluation(Chatroom $chatroom)
    {
        DB::transaction(function () use ($chatroom) {
            $request = [
                'star' => 2.5,
                'text' => ''
            ];
            $sender_user_id = $chatroom->buyer_user_id;
            $evaluation = $this->evaluation_service->storeReceiverEvaluationByCommand($request, $chatroom, $sender_user_id);
            $this->chatroom_message_service->storeEvaluationMessageByCommand($evaluation, $chatroom);
            $this->chatroom_service->statusChangeSellerEvaluation($chatroom);
            $this->user_notification_service->storeEvaluationUserNotificationMessage($chatroom);
        });
    }

    /**
     * 評価処理
     *
     * @param Chatroom $chatroom
     * @return void
     */
    private function processSellerEvaluation(Chatroom $chatroom)
    {
        DB::transaction(function () use ($chatroom) {
            $request = [
                'star' => 2.5,
                'text' => ''
            ];
            $sender_user_id = $chatroom->seller_user_id;
            $evaluation = $this->evaluation_service->storeReceiverEvaluationByCommand($request, $chatroom, $sender_user_id);
            $this->chatroom_message_service->storeEvaluationMessageByCommand($evaluation, $chatroom);
            $this->chatroom_service->statusChangeComplete($chatroom, $this->purchase_service);
            $this->user_notification_service->storeEvaluationUserNotificationMessage($chatroom);
            // 両者に取引完了pointを与える
            $this->point_service->getPoint(MPoint::TRANSACTION_COMPLETED, $chatroom->seller_user_id, $chatroom);
            $this->point_service->getPoint(MPoint::TRANSACTION_COMPLETED, $chatroom->buyer_user_id, $chatroom);

        });
    }
}
