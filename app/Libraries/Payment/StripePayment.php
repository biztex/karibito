<?php

namespace App\Libraries\Payment;

use Payjp\Charge;
use Payjp\Customer;
use Payjp\Token;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
class StripePayment implements PaymentInterface
{
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.stripe_secret_key') );
    }

    /**
     * クレカ一覧取得
     * @param string $customer_id
     * @param int $limit
     * @return array $cards->data
     */
    public function getCardList(string $customer_id, int $limit): array 
    {
        $cards = $this->stripe->customers->allSources(
            $customer_id,
            ['object' => 'card', 'limit' => $limit]
          );

        return $cards->data;
    }

    /**
     * 顧客登録
     * @return string $customer->id
     */
    public function createCustomer(): string 
    {
        $customer = $this->stripe->customers->create([
            "email" => \Auth::user()->email,
            'description' => 'User.id : '.\Auth::id(),
            "name" => \Auth::user()->userProfile->full_name,
          ]);

        return $customer->id;
    }

    /**
     * クレカ登録
     * @param string $customer_id
     * @param string $token
     * @return void
     */
    public function createCard(string $customer_id, string $token): void
    {
        $this->stripe->customers->createSource(
            $customer_id,
            ['source' => $token],
        );
    }

    /**
     * 顧客情報取得
     * @return string $customer->id
     */
    public function getCustomer(): string
    {
        $customer = $this->stripe->customers->retrieve(\Crypt::decryptString(\Auth::user()->stripe_id));

        return $customer->id;
    }

    /**
     * クレカ削除
     * @param string $customer_id
     * @param string $card_id
     * @return void
     */
    public function destroyCard(string $customer_id, string $card_id): void
    {
        $this->stripe->customers->deleteSource(
            $customer_id,
            $card_id,
            []
          );
    }

    /**
     * トークンからカード情報取得
     * @param string $token
     * @return object|array
     */
    public function getToken(string $token): object|array
    {
        $card = $this->stripe->tokens->retrieve(
            $token,
            []
          );
        return $card->card;
    }

    /**
     * クレカ情報取得
     * @param string $customer_id
     * @param string $card_id
     * @return object|array
     */
    public function getCard(string $customer_id, string $card_id): object|array
    {
        return $this->stripe->customers->retrieveSource(
            \Crypt::decryptString($customer_id),
            \Crypt::decryptString($card_id),
            []
          );
    }

    /**
     * 支払い処理(一時決済)
     * @param int $amount
     * @param string $token
     * @return mixed
     */
    public function createChargeByToken(int $amount, string $token): mixed
    {
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'jpy',
                'source' => $token,
                'description' => '', // 説明
            ]);

            return $charge->id;

        } catch (CardException $e) {
            $body = $e->getJsonBody();
            $flash_msg  = $body['error'];

            return back()->with('flash_msg', $flash_msg);
        }
    }

    /**
     * 支払い処理(登録カード使用)
     * @param int $amount
     * @param string $customer_id
     * @param string $card_id
     * @return mixed
     */
    public function createChargeByCustomer(int $amount, string $customer_id, string $card_id): mixed
    {
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'jpy',
                'customer' => $customer_id,
                'source' => $card_id,
                'description' => '', // 説明
            ]);

            return $charge->id;

        } catch (CardException $e) {
            $body = $e->getJsonBody();
            $flash_msg  = $body['error'];

            return back()->with('flash_msg', $flash_msg);
        }
    }

    /**
     * 全額返金
     * @param string $stripe_charge_id
     * @return string $refund->id
     */
    public function refundPayment(string $stripe_charge_id): string
    {
        $refund = $this->stripe->refunds->create([
            'charge' => $stripe_charge_id,
          ]);
        
          return $refund->id;
    }
 
}