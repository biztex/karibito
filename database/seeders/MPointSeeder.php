<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            ['name' => '初出品おめでとうポイント！', 'point' => '1000', 'deadline_period' => '12'] //仮で作成
        ];
        \DB::table('m_points')->insert($params);
    }
}
