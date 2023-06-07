<?php

namespace App\Console\Commands;

use App\Models\Chatroom;
use App\Services\ChatroomService;
use App\Services\PurchaseService;
use App\Services\UserNotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PaymentCommand extends Command
{
    private $chatroom_service;
    private $purchase_service;
    private $user_notification_service;

    public function __construct(
        ChatroomService $chatroom_service,
        PurchaseService $purchase_service,
        UserNotificationService $user_notification_service
    )
    {
        parent::__construct();
        $this->chatroom_service = $chatroom_service;
        $this->purchase_service = $purchase_service;
        $this->user_notification_service = $user_notification_service;
    }


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:PaymentCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '72時間以内に購入者側からの評価メッセージがない場合に決済を実行する';

    /**
     * Execute the console command.
     * 
     * @return void
     */
    public function handle()
    {
        // 72時間以内に購入者側からの評価メッセージがないChatroomのレコードを取得
        $chatrooms = Chatroom::where('status', Chatroom::STATUS_BUYER_EVALUATION)
            // ->where('updated_at', '<=', Carbon::now()->subHours(72))
            ->where('updated_at', '<=', Carbon::now()->subMinutes(5))
            ->get();

        // 決済処理の実行
        foreach ($chatrooms as $chatroom) {
            $this->processPayment($chatroom);
        }
    }

    /**
     * 決済処理
     *
     * @param Chatroom $chatroom
     * @return void
     */
    private function processPayment(Chatroom $chatroom)
    {
        DB::transaction(function () use ($chatroom) {
            // ステータスを「5:出品者評価」に変更
            $this->chatroom_service->statusChangeSellerEvaluation($chatroom, $this->purchase_service);
            // 売上金レコードの作成
            $this->chatroom_service->createProfit($chatroom, $this->purchase_service);
            // 評価メッセージ送信
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });
    }
}
