<?php

namespace App\Services;

use App\Models\UserCareer;
use App\Models\UserSkill;
use App\Models\Userjob;

class CareerService
{
    /**
     *  経歴を登録
     */
    public function storeUserCareer(array $params):UserCareer
    {
        $columns = ['name', 'first_year', 'first_month', 'last_year', 'last_month'];
        
        $usercareer = new UserCareer;
        $usercareer->user_id = \Auth::id();
        foreach($columns as $column){
            $usercareer->$column = $params[$column];
        }
        $usercareer->save();

        return $usercareer;
    }

     /**
     *  経歴を削除
     */
    public function deleteUserCareer($id):UserCareer
    {
        $usercareer = UserCareer::where('id', '=', $id)->first();
        $usercareer->delete();

        return $usercareer;
    }

}