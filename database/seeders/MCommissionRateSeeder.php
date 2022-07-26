<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MCommissionRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            'id'                 => 1,
            'rate'               => 15,
            'effective_datetime' => Carbon::now()
        ];
        \DB::table('m_commission_rates')->insert($params);
    }
}
