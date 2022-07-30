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
     * @return string
     */
    public function createCustomer(string $email, string $description): string;

    /**
     * クレカ登録
     * @param string $customer_id
     * @param string $token
     * @return string
     */
    public function createCard(string $customer_id, string $token): string;

    /**
     * クレカ一覧取得
     * @param string $customer_id
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getCardList(string $customer_id, int $limit, int $offset): array;
}