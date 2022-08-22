<?php

namespace App\Services;

use App\Models\UserCareer;

class CareerService
{
    /**
     *  経歴を登録
     */
    public function storeUserCareer(array $params): void
    {
        $columns = ['first_year', 'first_month', 'last_year', 'last_month'];
        
        $user_career = new UserCareer;
        $user_career->user_id = \Auth::id();
        $user_career->name = $params['career_name'];
        foreach($columns as $column){
            $user_career->$column = $params[$column];
        }
        $user_career->save();
        \Session::put('flash_msg','経歴を登録しました');
    }

     /**
     *  経歴を削除
     */
    public function deleteUserCareer(UserCareer $user_career): void
    {
        $user_career->delete();
        \Session::put('flash_msg','経歴を削除しました');

    }

}