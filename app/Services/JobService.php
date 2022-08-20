<?php

namespace App\Services;

use App\Models\UserJob;

class JobService
{
    /**
     *  職務を登録
     */
    public function storeUserJob(array $params): void
    {
        if(!\Auth::user()->userJob)
        {
            $user_job = new UserJob;
            $user_job->user_id = \Auth::id();
            $user_job->content = $params['content'];
            $user_job->save();

            \Session::put('flash_msg','職務を登録しました');

        } else {
            $user_job = \Auth::user()->userJob;
            $user_job->content = $params['content'];
            $user_job->save();
            
            \Session::put('flash_msg','職務を編集しました');

        }

    }
    
}