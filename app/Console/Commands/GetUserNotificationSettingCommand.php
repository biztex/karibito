<?php

namespace App\Console\Commands;

use App\Models\MCoupon;
use App\Models\User;
use App\Services\CouponService;
use Illuminate\Console\Command;

class GetUserNotificationSettingCommand extends Command
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:GetUserNotificationSettingCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '事前登録ユーザーに通知設定レコードを作成する';

    /**
     * Execute the console command.
     * 
     * @return void
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            if (!$user->userNotificationSetting) { // ユーザーに紐づくuserNotificationSettingがない場合
                $user->userNotificationSetting()->create();
            }
        }

        $this->info('通知設定レコードの作成が完了しました。');
    }
}
