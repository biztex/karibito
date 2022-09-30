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
     * 対象ユーザーの支払い一覧取得
     * @param int $user_id
     * @return object
     */
    public function getUserWithdrawals($user_id): object
    {
        return Payment::targetUser($user_id)->orderBy('id', 'desc')->paginate(20);
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
     * @return string stripeの返金id
     */
    public function refundStripe(Payment $payment): string
    {
        return $this->payment_interface->refundPayment(\Crypt::decryptString($payment->stripe_charge_id));
    }
}