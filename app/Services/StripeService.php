<?php

namespace App\Services;

use App\Libraries\Payment\PaymentInterface;
use App\Services\UserProfileService;

class StripeService
{
    private readonly PaymentInterface $payment_interface;
    private $user_profile_service;

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
     * クレカ一覧取得
     * @return array|null
     */
    public function getCardList(): array|null
    {
        if(\Auth::user()->stripe_id === null) {
            $cards = null;
        } else {
            $cards = $this->payment_interface->getCardList(\Crypt::decryptString(\Auth::user()->stripe_id), 10);
        }
        return $cards;
    }
   
    /**
     * クレカ登録
     * @param string $token
     * @return void
     */
    public function createCard(string $token)
    {
        // users.stripe_idがnullのとき顧客登録も行う
        if(\Auth::user()->stripe_id === null) {
            \DB::transaction(function () use ($token) {
                $customer_id = $this->payment_interface->createCustomer();
                $this->user_profile_service->fillCustomerId($customer_id);
                $this->payment_interface->createCard($customer_id, $token);
            });
        } else {
            \DB::transaction(function () use ($token) {
                $customer_id = $this->payment_interface->getCustomer();
                $this->payment_interface->createCard($customer_id, $token);
            });
        }
    }

     /**
     * クレカ削除
     * @params string $card_id
     */
    public function destroyCard(string $card_id): void
    {
        \DB::transaction(function () use ($card_id) {
            $customer_id = $this->payment_interface->getCustomer();
            $this->payment_interface->destroyCard($customer_id, $card_id);
        });
    }

    /**
     * トークン有無確認
     * @param array $request
     * @return string|null
     */
    public function checkToken(array $request)
    {
        if(isset($request['stripeToken'])) {
            $token = $request['stripeToken'];
        } else {
            $token = null;
        }
        return $token;
    }

    /**
     * クレカ情報取得
     * @param array $request
     * @return mixed
     */
    public function getCard(array $request): mixed
    {
        if($request['card_id'] === 'immediate'){
            $card = $this->payment_interface->getToken($request['stripeToken']);
        } else {
            $card = $this->payment_interface->getCard(\Auth::user()->stripe_id, $request['card_id']);
        }
        return $card;
    }

    /**
     * 支払い処理
     * @param array $request
     * @param int $amount
     */
    public function createCheckout(array $request, int $amount)
    {
        if($request['is_credit_save'] && $request['stripe_token'] !== null){
            $customer_id = $this->payment_interface->getCustomer();
            return $this->payment_interface->createChargeByCustomer($amount, $customer_id, \Crypt::decryptString($request['card_id']));
        }elseif($request['stripe_token'] !== null) {
            return $this->payment_interface->createChargeByToken($amount, \Crypt::decryptString($request['stripe_token']));
        } else {
            return $this->payment_interface->createChargeByCustomer($amount, $request['customer_id'], \Crypt::decryptString($request['card_id']));
        }
    }
}