<?php

namespace App\Libraries\Payment;

use Illuminate\Support\Facades\Log;

/**
 * スタブ(ダミーデータ)の決済クラス
 * 決済が使えない環境やテストでも使用できます
 */
class StubPayment implements PaymentInterface
{
    /**
     * 決済の実行
     * @param string $token
     * @param int $amount
     * @param string $currency
     * @return string charge_id
     */
    public function createCharge(string $token = '', int $amount = 1000, string $currency = ''): string
    {
        Log::info('StubPayment:決済実行完了');
        return 'ch_' . uniqid();
    }

    /**
     * 顧客登録
     * @param string $email
     * @param string $description
     * @return string customer_id
     */
    public function createCustomer(string $email = '', string $description = ''): string
    {
        Log::info('StubPayment:顧客登録完了');
        return 'cus_' . uniqid();
    }

     /**
     * 顧客情報取得
     * @param string $payjp_customer_id
     * @return string $customer->id
     */
    public function getCustomer(string $customer_id = ''): string
    {
        Log::info('StubPayment:顧客情報取得完了');
        return 'cus_' . uniqid();
    }

    /**
     * クレカ登録
     * @param string $customer_id
     * @param string $token
     * @return void
     */
    public function createCard(string $customer_id = '', string $token = '')
    {
        Log::info('StubPayment:クレカ登録完了');
    }

    /**
     * クレカ一覧取得
     * @param string $customer_id
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getCardList(string $customer_id = '', int $limit = 10, int $offset = 1): array
    {
        Log::info('StubPayment:クレカ一覧取得');
        return [
            [
                'id' => 'car_000000000000000000001',
                'brand' => 'Visa',
                'last4' => '1234',
                'exp_year' => '2025',
                'exp_month' => '12',
                'name' => 'YAMADA TARO'
            ],
            [
                'id' => 'car_000000000000000000002',
                'brand' => 'Mastercard',
                'last4' => '2345',
                'exp_year' => '2026',
                'exp_month' => '11',
                'name' => 'YAMADA TARO'
            ],
            [
                'id' => 'car_000000000000000000003',
                'brand' => 'JCB',
                'last4' => '3456',
                'exp_year' => '2027',
                'exp_month' => '10',
                'name' => 'YAMADA TARO'
            ],
        ];
    }

     /**
     * クレカ削除
     * @param string $customer_id
     * @param string $card_id
     * @return void
     */
    public function destroyCard(string $customer_id = '', string $card_id = '')
    {
        Log::info('StubPayment:クレカ削除');
    }
}