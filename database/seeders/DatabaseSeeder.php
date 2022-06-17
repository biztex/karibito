<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /** 実行したいSeederをここに登録 */
    private const SEEDERS = [
        PrefectureSeeder::class,
        MProductCategorySeeder::class,
        MProductChildCategorySeeder::class
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Admin::factory()->create([
            'name' => '管理者',
            'email' => 'admin@test.com',
        ]);
        foreach (self::SEEDERS as $seeder) {
            $this->call($seeder);
        }

        // ローカルのみ実行
        if (config('app.env') === 'local') {
            UserProfile::factory()->approved()->create(); // ローカルログイン用
            UserProfile::factory(9)->create();
        }
    }
}
