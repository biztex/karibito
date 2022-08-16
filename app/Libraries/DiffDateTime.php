<?php

namespace App\Libraries;

class DiffDateTime
{
    public static function dmTime($day1)
    {
        $diff_date_time = array();
        //秒の差を取得
        $dif_seconds = strtotime(now()) - strtotime($day1);        
        //分の差を取得
        $dif_minutes = ($dif_seconds - ($dif_seconds % 60)) / 60;
        //時の差を取得
        $dif_hours = ($dif_minutes - ($dif_minutes % 60)) / 60;
        $diff_date_time['hours'] = $dif_hours % 24;

        //日数の差を取得
        $dif_days = ($dif_hours - ($dif_hours % 24)) / 24;
        $diff_date_time['days'] = $dif_days;
        
        if($diff_date_time['days'] === 0)
        {
            return $diff_date_time['hours'].'時間前';
        }
        else
        {
            return $diff_date_time['days'].'日前';
        }
        
    }
}