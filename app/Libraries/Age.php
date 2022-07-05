<?php

namespace App\Libraries;

class Age
{
    /**
     * $birthday : 2020-01-01
     */
    public static function int_birthday(string|int|null $birthday): int
    {
        $int_birthday = (int) str_replace("-","",$birthday);
        return $int_birthday;
    }

    /**
     * $birthday : 2020-01-01 → 20200101
     */
    public static function nowAge(string|int|null $birthday): float
    { 
        $int_birthday = self::int_birthday($birthday);
        $now = (int) date('Ymd');
        $now_age = floor(($now - $int_birthday) / 10000);

        return $now_age; 
    }

    /**
     * $birthday : 2020-01-01 → 20200101
     */
    public static function group(string|int|null $birthday): string
    { 

        $int_birthday = self::int_birthday($birthday);
        $now_age = self::nowAge($birthday);
        if($now_age < 0 || $now_age > 150 || empty($now_age)){
            $age = '不明';
        }elseif($now_age < 20){
            $age = '10代';
        }elseif($now_age < 30){
            $age = '20代';
        }elseif($now_age < 40){
            $age = '30代';
        }elseif($now_age < 50){
            $age = '40代';
        }elseif($now_age < 60){
            $age = '50代';
        }elseif($now_age < 70){
            $age = '60代';
        }elseif($now_age > 69){
            $age = '70代以上';
        }else{
            $age = '不明';
        }

        return $age; 
    } 
}