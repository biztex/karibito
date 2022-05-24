<?php
namespace App\Libraries;

class Age
{
    /**
     * $birthday : 2020-01-01 → 20200101
     */
    public static function group(int $birthday) :string
    { 
        $now = (int)date('Ymd');
        $now_age = floor(($now - $birthday) / 10000);
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