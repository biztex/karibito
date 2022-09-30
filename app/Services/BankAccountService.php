<?php

namespace App\Services;

use App\Models\BankAccount;

class BankAccountService
{
    /**
     * 受取口座の登録・変更
     * @param array $params
     */
    public function update(array $params): void
    {
        if(\Auth::user()->bankAccount === null){
            $this->store($params);

        } else {
            $columns = ['bank_name', 'bank_code','branch_name','branch_code', 'type'];

            $bank_account = \Auth::user()->bankAccount;
            foreach($columns as $column){
                $bank_account->$column = $params[$column];
            }
            $bank_account->name = \Crypt::encryptString($params['bank_account_name']);
            $bank_account->number = \Crypt::encryptString($params['bank_account_number']);
            $bank_account->save();
        }
    }

    /**
     * 受取口座の新規登録
     * @param array $params
     */
    public function store(array $params): void
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
    }
}