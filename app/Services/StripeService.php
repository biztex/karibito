<?php

namespace App\Services;

use App\Libraries\Payment\PaymentInterface;
use App\Services\UserProfileService;

class StripeService
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
     * クレカ登録
     * @param string $token
     * @return void
     */
    public function createCard(string $token)
    {
        if(\Auth::user()->stripe_id === null) {
            $customer_id = $this->payment_interface->createCustomer();
            $this->user_profile_service->createCustomer($customer_id);
            $this->payment_interface->createCard($customer_id, $token);
            
        } else {
            $customer_id = $this->payment_interface->getCustomer();
            $this->payment_interface->createCard($customer_id, $token);
        }

    }
    
    /**
     * クレカ一覧取得
     * @return mixed
     */
    public function getCardList(): mixed
    {
        if(\Auth::user()->stripe_id === null) {
            $cards = null;
        } else {
            $cards = $this->payment_interface->getCardList(\Crypt::decryptString(\Auth::user()->stripe_id), 10);
        }
        return $cards;
    }
    
    /**
     * クレカ削除
     * @params string $card_id
     */
    public function destroyCard(string $card_id): void
    {
        $customer_id = $this->payment_interface->getCustomer();
        $this->payment_interface->destroyCard($customer_id, $card_id);
    }
}