<?php

namespace App\Libraries\Payment;

/**
 * 決済の実装
 */
interface Payment
{
    /**
     * 決済の実行
     * @param string $token
     * @param int $amount
     * @param string $currency
     * @return string charge_id
     */
    public function createCharge(string $token, int $amount, string $currency): string;

    /**
     * 顧客登録
     * @param string $email
     * @param string $description
     * @return string $customer_id
     */
    public function createCustomer(string $email, string $description): string;

    /**
     * 顧客情報取得
     * @param string $payjp_customer_id
     * @return string $customer_id
     */
    public function getCustomer(string $customer_id): string;
    
    /**
     * クレカ登録
     * @param string $customer_id
     * @param string $token
     * @return void
     */
    public function createCard(string $customer_id, string $token);

    /**
     * クレカ一覧取得
     * @param string $customer_id
     * @param int $limit
     * @param int $offset
     * @return array $cards
     */
    public function getCardList(string $customer_id, int $limit, int $offset): array;

    /**
     * クレカ削除
     * @param string $customer_id
     * @param string $card_id
     * @return void
     */
    public function destroyCard(string $customer_id, string $card_id);
}