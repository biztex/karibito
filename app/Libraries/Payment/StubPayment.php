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
     * クレカ一覧取得
     * @param string $customer_id
     * @param int $limit
     * @return array
     */
    public function getCardList(string $customer_id = '', int $limit = 10): array
    {
        Log::info('StubPayment:クレカ一覧取得');
        return [
            [
                'id' => 'car_000000000000000000001',
                'brand' => 'Visa',
                'last4' => '1234',
                'exp_year' => '2025',
                'exp_month' => '12',
                'name' => 'YAMADA TARO',
                'customer' => 'cus_0000000000000000',
            ],
            [
                'id' => 'car_000000000000000000002',
                'brand' => 'Mastercard',
                'last4' => '2345',
                'exp_year' => '2026',
                'exp_month' => '11',
                'name' => 'YAMADA TARO',
                'customer' => 'cus_0000000000000000',
            ],
            [
                'id' => 'car_000000000000000000003',
                'brand' => 'JCB',
                'last4' => '3456',
                'exp_year' => '2027',
                'exp_month' => '10',
                'name' => 'YAMADA TARO',
                'customer' => 'cus_0000000000000000',
            ],
        ];
    }

    /**
     * 顧客登録
     * @return string customer_id
     */
    public function createCustomer(): string
    {
        Log::info('StubPayment:顧客登録完了');
        return 'cus_' . uniqid();
    }

    /**
     * クレカ登録
     * @param string $customer_id
     * @param string $token
     * @return void
     */
    public function createCard(string $customer_id = '', string $token = ''): void
    {
        Log::info('StubPayment:クレカ登録完了');
    }

    /**
     * 顧客情報取得
     * @return string $customer_id
     */
    public function getCustomer(): string
    {
        Log::info('StubPayment:顧客情報取得完了');
        return 'cus_' . uniqid();
    }

    /**
     * クレカ削除
     * @param string $customer_id
     * @param string $card_id
     * @return void
     */
    public function destroyCard(string $customer_id = '', string $card_id = ''):void
    {
        Log::info('StubPayment:クレカ削除');
    }

    /**
     * トークンからカード情報取得
     * @param string $token
     * @return object|array
     */
    public function getToken(string $token): object|array
    {
        return [
            'id' => 'car_000000000000000000001',
            'brand' => 'Visa',
            'last4' => '1234',
            'exp_year' => '2025',
            'exp_month' => '12',
            'name' => 'YAMADA TARO',
        ];
    }

    /**
     * クレカ情報取得
     * @param string $customer_id
     * @param string $card_id
     * @return object|array
     */
    public function getCard(string $customer_id, string $card_id): object|array
    {
        return [
            'id' => 'car_000000000000000000001',
            'brand' => 'Visa',
            'last4' => '1234',
            'exp_year' => '2025',
            'exp_month' => '12',
            'name' => 'YAMADA TARO',
            'customer' => 'cus_0000000000000000',
        ];
    }

    /**
     * 支払い処理(一時決済)
     * @param int $amount
     * @param string $token
     * @return mixed
     */
    public function createChargeByToken(int $amount, string $token): mixed
    {
        Log::info('StubPayment:一時決済完了');
        return 'ch_' . uniqid();
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
        Log::info('StubPayment:登録カードで決済完了');
        return 'ch_' . uniqid();
    }

    /**
     * 全額返金
     * @param string $stripe_charge_id
     * @return string $refund_id
     */
    public function refundPayment(string $stripe_charge_id): string
    {
        Log::info('StubPayment:返金');
        return 're_' . uniqid();
    }

}