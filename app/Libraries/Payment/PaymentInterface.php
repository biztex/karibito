<?php

namespace App\Libraries\Payment;

/**
 * 決済の実装
 */
interface PaymentInterface
{

    /**
     * クレカ一覧取得
     * @param string $customer_id
     * @param int $limit
     * @return array $cards
     */
    public function getCardList(string $customer_id, int $limit): array;

    /**
     * 顧客登録
     * @return string $customer_id
     */
    public function createCustomer(): string;

    /**
     * クレカ登録
     * @param string $customer_id
     * @param string $token
     * @return void
     */
    public function createCard(string $customer_id, string $token): void;

    /**
     * 顧客情報取得
     * @return string $customer_id
     */
    public function getCustomer(): string;

    /**
     * クレカ削除
     * @param string $customer_id
     * @param string $card_id
     * @return void
     */
    public function destroyCard(string $customer_id, string $card_id): void;

    /**
     * トークンからカード情報取得
     * @param string $token
     * @return object|array
     */
    public function getToken(string $token): object|array;

    /**
     * クレカ情報取得
     * @param string $customer_id
     * @param string $card_id
     * @return object|array
     */
    public function getCard(string $customer_id, string $card_id): object|array;

    /**
     * 支払い処理(一時決済)
     * @param int $amount
     * @param string $token
     * @return mixed
     */
    public function createChargeByToken(int $amount, string $token): mixed;

    /**
     * 支払い処理(登録カード使用)
     * @param int $amount
     * @param string $customer_id
     * @param string $card_id
     * @return mixed
     */
    public function createChargeByCustomer(int $amount, string $customer_id, string $card_id): mixed;

     /**
     * 全額返金
     * @param string $stripe_charge_id
     * @return string $refund_id
     */
    public function refundPayment(string $stripe_charge_id): string;
    
}