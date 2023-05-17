<?php

namespace App\Console\Commands;

use App\Models\Chatroom;
use App\Services\ChatroomMessageService;
use App\Services\ChatroomService;
use App\Services\EvaluationService;
use App\Services\UserNotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Biohazard\LaravelConsoleDebug\Facades\Debug;

class ChatroomDeliveryCompleteCommand extends Command
{
    private $chatroom_service;
    private $evaluation_service;
    private $chatroom_message_service;
    private $user_notification_service;

    public function __construct(
        ChatroomService $chatroom_service,
        EvaluationService $evaluation_service,
        ChatroomMessageService $chatroom_message_service,
        UserNotificationService $user_notification_service
    )
    {
        parent::__construct();
        $this->chatroom_service = $chatroom_service;
        $this->evaluation_service = $evaluation_service;
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
        // 納品完了された後、72時間以内に評価の未入力のChatroomのレコードを取得
        $chatrooms = Chatroom::where(function ($query) {
            $query->where('status', Chatroom::STATUS_WORK_REPORT)
                ->orwhere('status', Chatroom::STATUS_BUYER_EVALUATION);
        })->where('updated_at', '<=', Carbon::now()->subHours(72))
            ->get();

        // 処理の実行
        foreach ($chatrooms as $chatroom) {
            if ($chatroom->status === Chatroom::STATUS_WORK_REPORT) {
                $this->processSenderEvaluation($chatroom);
                $this->processReceiverEvaluation($chatroom);
            } else if ($chatroom->status === Chatroom::STATUS_BUYER_EVALUATION) {
                $this->processReceiverEvaluation($chatroom);
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
            $sender_user_id = $chatroom->buyer_user_id;
            $evaluation = $this->evaluation_service->storeSenderEvaluationByCommand($request, $chatroom, $sender_user_id);
            $this->chatroom_message_service->storeEvaluationMessageByCommand($evaluation, $chatroom);
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
    private function processReceiverEvaluation(Chatroom $chatroom)
    {
        DB::transaction(function () use ($chatroom) {
            $request = [
                'star' => 2.5,
                'text' => ''
            ];
            $sender_user_id = $chatroom->seller_user_id;
            $evaluation = $this->evaluation_service->storeReceiverEvaluationByCommand($request, $chatroom, $sender_user_id);
            $this->chatroom_message_service->storeEvaluationMessageByCommand($evaluation, $chatroom);
            $this->chatroom_service->statusChangeSellerEvaluation($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });
    }
}
