<?php

namespace App\Services;

use App\Models\UserCareer;
use App\Models\UserSkill;
use App\Models\UserJob;

class JobService
{
    /**
     *  職務を登録
     */
    public function storeUserJob(array $params):UserJob
    {
        $columns = ['content'];

        $userjob = new UserJob;
        $userjob->user_id = \Auth::id();
        foreach($columns as $column){
            $userjob->$column = $params[$column];
        }
        $userjob->save();

        return $userjob;
    }

    public function updateUserJob(array $params):UserJob
    {
        $id =  \Auth::id();
        $job = UserJob::where('user_id', '=', $id)->first();
        $columns = ['content'];

        foreach($columns as $column){
            $job->$column = $params[$column];
        }
        $job->save();

        return $job;
    }
    
}