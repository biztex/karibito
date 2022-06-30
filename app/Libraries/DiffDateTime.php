<?php

namespace App\Libraries;

class DiffDateTime
{
    /**
     * 日数と時間の計算
     */
    public static function diff_date_time($day1, $day2)
    {
        $diff_date_time = array();
        $day2 = strtotime($day2);
        //秒の差を取得
        $dif_seconds = strtotime('+1 day', $day2) - strtotime($day1);        
        //分の差を取得
        $dif_minutes = ($dif_seconds - ($dif_seconds % 60)) / 60;
        //時の差を取得
        $dif_hours = ($dif_minutes - ($dif_minutes % 60)) / 60;
        $diff_date_time['hours'] = $dif_hours % 24;

        //日数の差を取得
        $dif_days = ($dif_hours - ($dif_hours % 24)) / 24;
        $diff_date_time['days'] = $dif_days;
        
        //結果を返す
        return $diff_date_time;
    }
}