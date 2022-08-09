<?php

namespace App\Services;

use App\Models\BankAccount;

class BankAccountService
{
    /**
     * 新規リクエスト投稿
     */
    public function updateBankAccount(array $params): BankAccount
    {
        if(\Auth::user()->bankAccount === null){
            return $this->storeBankAccount($params);
        } else {
            $columns = ['bank_name', 'bank_code','branch_name','branch_code', 'type'];

            $bank_account = \Auth::user()->bankAccount;
            foreach($columns as $column){
                $bank_account->$column = $params[$column];
            }
            $bank_account->name = \Crypt::encryptString($params['bank_account_name']);
            $bank_account->number = \Crypt::encryptString($params['bank_account_number']);
            $bank_account->save();

            return $bank_account;
        }
    }

    /**
     * 新規リクエスト投稿
     */
    public function storeBankAccount(array $params): BankAccount
    {
        $columns = ['bank_name', 'bank_code','branch_name','branch_code', 'type'];

            $bank_account = new BankAccount();
            $bank_account->user_id = \Auth::id();

            foreach($columns as $column){
                $bank_account->$column = $params[$column];
            }

            $bank_account->name = \Crypt::encryptString($params['bank_account_name']);
            $bank_account->number = \Crypt::encryptString($params['bank_account_number']);
        $bank_account->save();

        return $bank_account;
    }
}