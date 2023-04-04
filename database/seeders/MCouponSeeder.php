<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            ['name' => '新規会員登録 500円OFFクーポン', 'content' => '5,000円以上のお支払いでご利用いただけます。お1人様1回限り使用可能です。ポイント、他のクーポンとの併用はできません', 'discount' => 500, 'min_price' => 5000, 'deadline_period' => '6'],
            ['name' => 'カリビトアンケート回答 100円OFFクーポン', 'content' => '1,000円以上のお支払いでご利用いただけます。お1人様1回限り使用可能です。ポイント、他のクーポンとの併用はできません', 'discount' => 100, 'min_price' => 1000, 'deadline_period' => '6'],
        ];
        \DB::table('m_coupons')->insert($params);
    }
}
