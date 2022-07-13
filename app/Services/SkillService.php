<?php

namespace App\Services;

use App\Models\UserCareer;
use App\Models\UserSkill;
use App\Models\Userjob;

class SkillService
{
    /**
     *  スキルを登録
     */
    public function storeUserSkill(array $params):UserSkill
    {
        $columns = ['name', 'year'];

        $userskill = new UserSkill;
        $userskill->user_id = \Auth::id();
        foreach($columns as $column){
            $userskill->$column = $params[$column];
        }
        $userskill->save();

        return $userskill;
    }

}