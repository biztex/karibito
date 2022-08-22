<?php

namespace App\Services;

use App\Models\UserSkill;

class SkillService
{
    /**
     *  スキルを登録
     */
    public function storeUserSkill(array $params): void
    {
        $user_skill = new UserSkill;
        $user_skill->user_id = \Auth::id();
        $user_skill->name = $params['skill_name'];
        $user_skill->year = $params['year'];
        $user_skill->save();

        \Session::put('flash_msg','スキルを登録しました');
    }

     /**
     *  スキルを削除
     */
    public function deleteUserSkill(UserSkill $user_skill): void
    {
        $user_skill->delete();
        \Session::put('flash_msg','職務を削除しました');


    }

}