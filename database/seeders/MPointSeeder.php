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
            ['name' => '取引完了時付与ポイント', 'point' => '100', 'deadline_period' => null],
            ['name' => '出品登録時付与ポイント', 'point' => '100', 'deadline_period' => null],
            ['name' => '友達招待時(新規登録コード入力時)付与ポイント', 'point' => '300', 'deadline_period' => null],
            ['name' => '本人認証時付与ポイント', 'point' => '300', 'deadline_period' => null],
            // ['name' => 'カリビトをご登録していただきありがとうございます！', 'point' => '1000', 'deadline_period' => '12'], //仮で作成
            // ['name' => '初出品おめでとうポイント！', 'point' => '1000', 'deadline_period' => '12'], //仮で作成
        ];
        \DB::table('m_points')->insert($params);
    }
}
