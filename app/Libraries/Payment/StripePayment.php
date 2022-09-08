<?php

namespace App\Libraries\Payment;

use Payjp\Charge;
use Payjp\Customer;
use Payjp\Token;
use Stripe\StripeClient;

class StripePayment implements PaymentInterface
{
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.stripe_secret_key') );
    }

    /**
     * 顧客カードの決済の実行
     * @param string $card_id
     * @param string $customer_id
     * @param int $amount
     * @param string $currency
     * @return string $charge_id
     */
    // public function createCustomerCharge(string $card_id, string $customer_id, int $amount, string $currency): string
    // {
    //     $charge = Charge::create(array(
    //         "card" => $card_id,
    //         "amount" => $amount,
    //         "currency" => $currency,
    //         "customer" => $customer_id
    //         // "tenant" => "ten_xxx" // PAY.JP Platformでは必須
    //     ));
    //     return $charge->id;
    // }

    /**
     * 決済の実行
     * @param string $token
     * @param int $amount
     * @param string $currency
     * @return string charge_id
     */
    // public function createCharge(string $token, int $amount, string $currency): string
    // {
    //     $charge = Charge::create(array(
    //         "card" => $token,
    //         "amount" => $amount,
    //         "currency" => $currency,
    //         // "tenant" => "ten_xxx" // PAY.JP Platformでは必須
    //     ));
    //     return $charge->id;
    // }

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
     * 顧客情報取得
     * @return string $customer->id
     */
    public function getCustomer(): string
    {
        $customer = $this->stripe->customers->retrieve(\Crypt::decryptString(\Auth::user()->stripe_id));

        return $customer->id;
    }
    
    /**
     * カードトークン発行
     * @param array $params
     * @return string $token->id
     */
    // public function createToken(array $params): string
    // {
    //     $params = [
    //         'card' => [
    //             "number" => $params['cc_number'],
    //             "exp_month" => $params['exp_month'],
    //             "exp_year" => $params['exp_year'],
    //             "name" => $params['cc_name'],
    //         ]
    //     ];
    //     $token = Token::create($params, $options = ['payjp_direct_token_generate' => 'true']);
    //     return $token->id;
    // }

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
     * クレカ情報取得
     * @param string $customer_id
     * @param string $payjp_card_id
     * @return array $card
     */
    // public function getCard(string $customer_id, string $payjp_card_id): object
    // {
    //     $customer = Customer::retrieve($customer_id);
    //     $card = $customer->cards->retrieve($payjp_card_id);
    //     return $card;
    // }

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
     * クレカ削除
     * @param string $customer_id
     * @param string $card_id
     * @return void
     */
    public function destroyCard(string $customer_id, string $card_id)
    {
        $this->stripe->customers->deleteSource(
            $customer_id,
            $card_id,
            []
          );
    }

    /**
     * 全額返金
     * @param string $payjp_charge_id
     * @return void
     */
    // public function refundPayment(string $payjp_charge_id)
    // {
    //     $ch = Charge::retrieve($payjp_charge_id);
    //     $ch->refund();
    // }
}