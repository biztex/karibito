<?php

namespace App\Libraries\Payment;

use Payjp\Charge;
use Payjp\Payjp;

class PayjpPayment implements Payment
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

    public function createCustomer(string $email, string $description): string {}

    public function createCard(string $customer_id, string $token): string {}

    public function getCardList(string $customer_id, int $limit, int $offset): array {}
}