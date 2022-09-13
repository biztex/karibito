<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            ['id' => 1, 'name' => '家事'],
            ['id' => 2, 'name' => '修理組立'],
            ['id' => 3, 'name' => 'ペット'],
            ['id' => 4, 'name' => '高齢者向け'],
            ['id' => 5, 'name' => '乗り物'],
            ['id' => 6, 'name' => '引っ越し'],
            ['id' => 7, 'name' => '趣味・習い事'],
            ['id' => 8, 'name' => '美容・ファッション'],
            ['id' => 9, 'name' => '写真・動画制作'],
            ['id' => 10, 'name' => 'その他'],
            ['id' => 11, 'name' => 'インテリア'],
            ['id' => 12, 'name' => 'デザイン'],
            ['id' => 13, 'name' => 'パソコン'],
            ['id' => 14, 'name' => 'ビジネスサポート'],
            ['id' => 15, 'name' => '冠婚葬祭'],
            ['id' => 16, 'name' => '料理'],
            ['id' => 17, 'name' => '恋愛・結婚'],
            ['id' => 18, 'name' => '体験・アクティビティ'],
            ['id' => 19, 'name' => '出張サービス'],
            ['id' => 20, 'name' => '調べもの'],
            ['id' => 21, 'name' => 'レンタル'],
            ['id' => 22, 'name' => 'イラスト・漫画'],
            ['id' => 23, 'name' => 'マーケティング・Web集客'],
            ['id' => 24, 'name' => 'ライティング・翻訳'],
            ['id' => 25, 'name' => '学習・就職・資格・コーチング'],
            ['id' => 26, 'name' => 'マネー・副業・アフィリエイト']
        ];
        \DB::table('m_product_categories')->insert($params);
    }
}
