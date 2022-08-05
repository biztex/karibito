<?php

namespace App\Services\Sample;

use App\Libraries\Payment\Payment;
use App\Libraries\Payment\PaymentInterface;

class PaymentService
{
    private readonly PaymentInterface $payment_interface;

    /**
     * $paymentのインスタンスはenvに設定されている内容によって変化する
     * App\Providers\PaymentServiceProvider参照
     * @param Payment $payment
     */
    public function __construct(PaymentInterface $payment_interface)
    {
        $this->payment_interface = $payment_interface;
    }

    /**
     * 決済の実行
     * @param array $params
     * @return void
     */
    public function createCharge(array $params)
    {
        $charge_id = $this->payment_interface->createCharge($params['payjp-token'], 3000, 'jpy');
        dump($charge_id);
    }

    /**
     * クレカ登録
     * @param array $params
     * @return void
     */
    public function createCard(array $params)
    {
        $customer_id = $this->payment_interface->createCustomer();
        $card_id = $this->payment_interface->createCard($customer_id, $params['createCustomer-payjp-token']);
        dump($card_id);
    }

    /**
     * クレカ一覧取得
     * @return array
     */
    public function getCardList(): array
    {
        $customer_id = 'cus_000000000000000000000'; // DBから取得
        return $this->payment_interface->getCardList($customer_id, 10, 1);
    }
}