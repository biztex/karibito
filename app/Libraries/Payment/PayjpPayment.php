<?php

namespace App\Libraries\Payment;

use Payjp\Charge;
use Payjp\Payjp;
use Payjp\Customer;

class PayjpPayment implements PaymentInterface
{
    public function __construct()
    {
        Payjp::setApiKey(config('payjp.secret_key'));
    }

    /**
     * 決済の実行
     * @param string $token
     * @param int $amount
     * @param string $currency
     * @return string charge_id
     */
    public function createCharge(string $token, int $amount, string $currency = 'jpy'): string
    {
        $charge = Charge::create(array(
            "card" => $token,
            "amount" => $amount,
            "currency" => $currency,
            // "tenant" => "ten_xxx" // PAY.JP Platformでは必須
        ));
        return $charge->id;
    }

    /**
     * 顧客登録
     * @param string $email
     * @param string $description
     * @return string $customer->id
     */
    public function createCustomer(string $email, string $description): string 
    {
        $customer = Customer::create(array(
                "email" => $email,
                "description" => $description,
        ));
        return $customer->id;
    }

    /**
     * 顧客情報取得
     * @param string $payjp_customer_id
     * @return string $customer->id
     */
    public function getCustomer(string $customer_id): string
    {
        $customer = Customer::retrieve($customer_id);
        
        return $customer->id;
    }
    

    /**
     * クレカ登録
     * @param string $customer_id
     * @param string $token
     * @return void
     */
    public function createCard(string $customer_id, string $token) 
    {
        $customer = Customer::retrieve($customer_id);
        $customer->cards->create([
            "card" => $token,
        ]);

    }

    /**
     * クレカ一覧取得
     * @param string $customer_id
     * @param int $limit
     * @param int $offset
     * @return array $cards->data
     */
    public function getCardList(string $customer_id, int $limit, int $offset): array 
    {
        $cards = Customer::retrieve($customer_id)->cards->all(array("limit"=>$limit, "offset"=>$offset));
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
        $customer = Customer::retrieve($customer_id);
        $card = $customer->cards->retrieve($card_id);
        $card->delete();
    }
}