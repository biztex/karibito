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
            ['name' => 'アンケート記入いただいた皆様にプレゼント', 'content' => 'プレゼントです。', 'discount' => 100, 'min_price' => 1000, 'deadline_period' => '2022-12-22']
        ];
        \DB::table('m_coupons')->insert($params);
    }
}
