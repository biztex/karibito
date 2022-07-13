<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UserNotificationSetting;


class UserNotificationSettingService
{

    public function updateSetting(array $params, $id)
    {
        $columns = ['is_like', 'is_posting', 'is_fav', 'is_arrival', 'is_news', 'is_promo',];

        $setting = UserNotificationSetting::find($id);

        foreach($columns as $column){
                $setting->$column = $params[$column];
        }
        $setting->save();
        return $setting;
    }
}