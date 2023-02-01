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
            ['name' => 'アンケート回答でプレゼント', 'content' => '300円OFFクーポン', 'discount' => 300, 'min_price' => 1000, 'deadline_period' => '3'],
            ['name' => '新規会員登録', 'content' => '500円OFFクーポン', 'discount' => 500, 'min_price' => 1000, 'deadline_period' => '3'],
            ['name' => '友達招待', 'content' => '1000円OFFのクーポン', 'discount' => 1000, 'min_price' => 3000, 'deadline_period' => '3']
        ];
        \DB::table('m_coupons')->insert($params);
    }
}
