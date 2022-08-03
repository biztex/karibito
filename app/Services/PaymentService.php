<?php

namespace App\Services;

use App\Libraries\Payment\PaymentInterface;
use Dotenv\Util\Str;

class PaymentService
{
    private readonly PaymentInterface $payment_interface;

    /**
     * $paymentのインスタンスはenvに設定されている内容によって変化する
     * App\Providers\PaymentServiceProvider参照
     * @param PaymentInterface $payment_interface
     */
    public function __construct(PaymentInterface $payment_interface)
    {
        $this->payment_interface = $payment_interface;
    }

    /**
     * 顧客登録
     * @return string $customer_id
     */
    public function createCustomer(): string
    {
        $customer_id = $this->payment_interface->createCustomer(\Auth::user()->email, \Auth::user()->name);
        
        return $customer_id;
    }
    
    /**
     * 顧客情報取得
     * @return string $customer_id
     */
    public function getCustomer(): string
    {
        $customer_id = $this->payment_interface->getCustomer(\Auth::user()->payjp_customer_id);

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
        $card_id = $this->payment_interface->createCard($customer_id, $params['createCustomer-payjp-token']);
    }



    /**
     * 決済の実行
     * @param array $params
     * @return void
     */
    // public function createCharge(array $params)
    // {
    //     $charge_id = $this->payment_interface->createCharge($params['payjp-token'], 3000);
    //     dump($charge_id);
    // }

    

    /**
     * クレカ一覧取得
     * @return array $cards
     */
    public function getCardList(): array
    {
        $cards = $this->payment_interface->getCardList(\Auth::user()->payjp_customer_id, 10, 0);
        return $cards;
    }

    /**
     * クレカ削除
     * @param string $customer_id
     * @param string $card_id
     * @return void
     */
    public function destroyCard(string $customer_id, string $card_id)
    {
        $this->payment_interface->destroyCard($customer_id, $card_id);
    }
}