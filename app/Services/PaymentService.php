<?php

namespace App\Services;

use App\Libraries\Payment\PaymentInterface;
use App\Services\UserProfileService;
use  App\Models\Payment;
use Dotenv\Util\Str;

class PaymentService
{
    private readonly PaymentInterface $payment_interface;

    /**
     * $paymentのインスタンスはenvに設定されている内容によって変化する
     * App\Providers\PaymentServiceProvider参照
     * @param PaymentInterface $payment_interface
     */
    public function __construct(PaymentInterface $payment_interface, UserProfileService $user_profile_service)
    {
        $this->payment_interface = $payment_interface;
        $this->user_profile_service = $user_profile_service;
    }

    /**
     * 対象ユーザーの入金一覧取得
     * @param int $user_id
     * @return object $deposits
     */
    public function getUserDeposits(int $user_id): object
    {
        // リファクタリング可能そう
        $chatroom_ids = \App\Models\Chatroom::sellService($user_id)->pluck('id');
        $payment_ids = \App\Models\Purchase::whereIn('chatroom_id',$chatroom_ids)->pluck('payment_id');
        $deposits = Payment::whereIn('id', $payment_ids)->orderBy('id', 'desc')->paginate(20);

        return $deposits;
    }

    /**
     * 対象ユーザーの支払い一覧取得
     * @param int $user_id
     * @return object $withdrawals
     */
    public function getUserWithdrawals($user_id): object
    {
        $withdrawals = Payment::targetUser($user_id)->orderBy('id', 'desc')->paginate(20);

        return $withdrawals;
    }

    /**
     * 全額返金
     * @param object $payment
     * @return void
     */
    public function refundPayment(Payment $payment)
    {
        $stripe_refund_id = $this->refundStripe($payment);

        $payment->fill([
            'stripe_refund_id' => \Crypt::encryptString($stripe_refund_id),
            'amount_refunded' => $payment->amount,
            'refunded_at' => \Carbon\Carbon::now()
        ])->save();
    }

    /**
     * stripe全額返金処理
     * @param object $payment
     * @return string
     */
    public function refundStripe(Payment $payment)
    {
        return $this->payment_interface->refundPayment(\Crypt::decryptString($payment->stripe_charge_id));
    }
}