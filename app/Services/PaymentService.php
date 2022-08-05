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
     * カードトークン発行
     * @param array $params
     * @return string $token
     */
    public function createToken(array $params): string
    {
        $token = $this->payment_interface->createToken($params);

        return $token;
    }

    /**
     * クレカ登録
     * @param array $params
     * @return void
     */
    public function createCard(array $params)
    {
        if(\Auth::user()->payjp_customer_id === null) {
            $customer_id = $this->createCustomer();
            $this->user_profile_service->createPayjpCustomer($customer_id);
        } else {
            $customer_id = $this->getCustomer();
        }
        $token = $this->payment_interface->createToken($params);

        $card_id = $this->payment_interface->createCard($customer_id, $token);
    }

    /**
     * Paymentテーブル作成
     * @param string $payjp_charge_id
     * @param int $amount
     * @return Payment $payment
     */
    public function storePayment(string $payjp_charge_id, int $amount): Payment
    {
        $column = [
            'payjp_charge_id' => $payjp_charge_id,
            'amount' => $amount,
        ];
        $payment = \Auth::user()->payments()->create($column);

        return $payment;
    }


    /**
     * 顧客カードの決済の実行
     * @param string $card_id
     * @param string $customer_id
     * @param int $amount
     * @param string $currency
     * @return string $charge_id
     */
    public function createCustomerCharge(string $card_id, string $customer_id, int $amount, string $currency): string
    {
        $charge_id = $this->payment_interface->createCustomerCharge($card_id, $customer_id, $amount, $currency);

        return $charge_id;
    }

    /**
     * 決済の実行
     * @param string $token
     * @param int $amount
     * @return string $charge_id
     */
    public function createCharge(array $params): string
    {
        if($params['immediate'] === null) {
            $charge_id = $this->createCustomerCharge($params['card_id'], $params['customer_id'], $params['amount'], 'jpy');
        } else {
            $token = $this->createToken($params);
            $charge_id = $this->payment_interface->createCharge($token, $params['amount'], 'jpy');
        }

        return $charge_id;
    }

    

    /**
     * クレカ情報取得
     * @param string $payjp_card_id
     * @return mixed
     */
    public function getCard(string $payjp_card_id): mixed
    {
        if($payjp_card_id === 'immediate'){
            $card = null;
        } else {
            $card = $this->payment_interface->getCard(\Auth::user()->payjp_customer_id, $payjp_card_id);
        }
        return $card;
    }


    /**
     * クレカ一覧取得
     * @return mixed
     */
    public function getCardList(): mixed
    {
        if(\Auth::user()->payjp_customer_id === null) {
            $cards = null;
        } else {
            $cards = $this->payment_interface->getCardList(\Auth::user()->payjp_customer_id, 10, 0);
        }
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

    /**
     * 全額返金
     * @param object $payment
     * @return void
     */
    public function refundPayment(Payment $payment)
    {
        $payment->fill([
            'amount_refunded' => $payment->amount,
            'refunded_at' => \Carbon\Carbon::now()
        ])->save();

        $this->refundPayjp($payment);
    }

    /**
     * Payjp全額返金処理
     * @param object $payment
     * @return void
     */
    public function refundPayjp(Payment $payment)
    {
        $payjp_charge_id = $payment->payjp_charge_id;
        $this->payment_interface->refundPayment($payjp_charge_id);
    }
}