<?php
namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;

use App\Http\Requests\UserProfile\StoreRequest;


/**
 * ユーザー情報のサービスクラス
 * @package App\Services
 */
class UserProfileService
{

    public function updateUser($params)
    {
        $user = User::find(\Auth::id());
        $user->fill([ 'name' => $params['name'] ])->save();

        return $user;
    }



    /**
     * 全ユーザー情報取得
     * @return Collection 全ユーザー情報
     */
    public function storeUserProfile($params)
    {
        $user_profile = UserProfile::create([
            'user_id' => \Auth::id(),
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name'],
            'gender' => $params['gender'],
            'prefecture_id' => $params['prefecture']
        ]);
        return $user_profile->save();
    
    }
}