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
            ['name' => 'アンケート記入いただいた皆様にプレゼント', 'content' => 'プレゼントです。', 'discount' => 100, 'min_price' => 1000, 'deadline_period' => '3'],
            ['name' => '新規会員登録 500円OFFクーポン', 'content' => '500円OFFのクーポンです。', 'discount' => 500, 'min_price' => 1000, 'deadline_period' => '3'],
            ['name' => '友達招待 1000円OFFクーポン', 'content' => '1000円OFFのクーポンです。', 'discount' => 1000, 'min_price' => 3000, 'deadline_period' => '3']
        ];
        \DB::table('m_coupons')->insert($params);
    }
}
