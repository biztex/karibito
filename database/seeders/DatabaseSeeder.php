<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductChildCategory;
use Database\Seeders\PrefectureSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /** 実行したいSeederをここに登録 */
    private const SEEDERS = [
        PrefectureSeeder::class,
        ProductCategorySeeder::class,
        ProductChildCategorySeeder::class
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        foreach(self::SEEDERS as $seeder) {
            $this->call($seeder);
        };
    }
}
