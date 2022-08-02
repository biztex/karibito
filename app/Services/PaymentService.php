<?php

namespace App\Services;

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
     * 顧客登録
     * @return string $customer_id
     */
    public function createCustomer(): string
    {
        $customer_id = $this->payment->createCustomer(\Auth::user()->email, \Auth::user()->name);
        
        return $customer_id;
    }
    
    /**
     * 顧客情報取得
     * @return string $customer_id
     */
    public function getCustomer(): string
    {
        $customer_id = $this->payment->getCustomer(\Auth::user()->payjp_customer_id);

        return $customer_id;
    }

    /**
     * クレカ登録
     * @param string $customer_id
     * @param array $params
     * @return void
     */
    public function createCard(string $customer_id, array $params)
    {
        $card_id = $this->payment->createCard($customer_id, $params['createCustomer-payjp-token']);
    }



    /**
     * 決済の実行
     * @param array $params
     * @return void
     */
    // public function createCharge(array $params)
    // {
    //     $charge_id = $this->payment->createCharge($params['payjp-token'], 3000);
    //     dump($charge_id);
    // }

    

    /**
     * クレカ一覧取得
     * @return array
     */
    // public function getCardList(): array
    // {
    //     $customer_id = 'cus_000000000000000000000'; // DBから取得
    //     return $this->payment->getCardList($customer_id, 10, 1);
    // }
}