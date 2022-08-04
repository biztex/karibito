<?php

namespace App\Libraries\Payment;

/**
 * 決済の実装
 */
interface PaymentInterface
{
    /**
     * 顧客カードの決済の実行
     * @param string $card_id
     * @param string $customer_id
     * @param int $amount
     * @param string $currency
     * @return string $charge_id
     */
    public function createCustomerCharge(string $card_id, string $customer_id, int $amount, string $currency): string;

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
     * カードトークン発行
     * @param array $params
     * @return string $token
     */
    public function createToken(array $params): string;

    /**
     * クレカ登録
     * @param string $customer_id
     * @param string $token
     * @return void
     */
    public function createCard(string $customer_id, string $token);

    /**
     * クレカ情報取得
     * @param string $customer_id
     * @param string $payjp_card_id
     * @return array $card
     */
    public function getCard(string $customer_id, string $payjp_card_id): object|array;

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