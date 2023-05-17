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

class ChatroomWorkReportCommand extends Command
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
    protected $signature = 'command:ChatroomWorkReportCommand';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // 修正箇所がある場合、72時間が経過すると自動的に承認となります
        $chatrooms = Chatroom::where(function ($query) {
            $query->where('status', Chatroom::STATUS_WORK);
        })->where('updated_at', '<=', Carbon::now()->subHours(72))
            ->get();

        // 処理の実行
        foreach ($chatrooms as $chatroom) {
            $this->processWorkReport($chatroom);
        }
    }

    /**
     * 納品完了処理
     *
     * @param Chatroom $chatroom
     * @return void
     */
    private function processWorkReport(Chatroom $chatroom)
    {
        DB::transaction(function () use ($chatroom) {
            $this->chatroom_service->statusChangeWorkReport($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });
    }
}
