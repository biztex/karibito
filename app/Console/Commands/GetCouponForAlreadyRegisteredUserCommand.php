<?php

namespace App\Console\Commands;

use App\Models\MCoupon;
use App\Models\User;
use App\Services\CouponService;
use Illuminate\Console\Command;

class GetCouponForAlreadyRegisteredUserCommand extends Command
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public CouponService $coupon_service;

    public function __construct(CouponService $coupon_service)
    {
        parent::__construct();
        $this->coupon_service = $coupon_service;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:GetCouponForAlreadyRegisteredUserCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'すでに登録されているユーザーに事前会員登録500円OFFクーポンを配布する';

    /**
     * Execute the console command.
     * 
     * @return void
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $this->coupon_service->createUserCoupon(MCoupon::ALREADY_REGISTRATION, $user->id);
        }
    }
}
