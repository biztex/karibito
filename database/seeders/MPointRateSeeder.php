<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MPointRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            ['rate' => '10', 'effective_datetime' => '2022-08-05']
        ];
        \DB::table('m_point_rates')->insert($params);
    }
}
