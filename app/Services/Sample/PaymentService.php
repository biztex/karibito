<?php

namespace App\Services\Sample;

use App\Libraries\Payment\Payment;

class PaymentService
{
    private readonly Payment $payment;

    /**
     * $paymentのインスタンスはenvに設定されている内容によって変化する
     * App\Providers\PaymentServiceProvider参照
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * 決済の実行
     * @param array $params
     * @return void
     */
    public function createCharge(array $params)
    {
        $charge_id = $this->payment->createCharge($params['payjp-token'], 3000);
        dump($charge_id);
    }

    /**
     * クレカ登録
     * @param array $params
     * @return void
     */
    public function createCard(array $params)
    {
        $customer_id = $this->payment->createCustomer();
        $card_id = $this->payment->createCard($customer_id, $params['createCustomer-payjp-token']);
        dump($card_id);
    }

    /**
     * クレカ一覧取得
     * @return array
     */
    public function getCardList(): array
    {
        $customer_id = 'cus_000000000000000000000'; // DBから取得
        return $this->payment->getCardList($customer_id, 10, 1);
    }
}