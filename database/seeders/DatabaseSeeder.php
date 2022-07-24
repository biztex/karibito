<?php

namespace Database\Seeders;

use App\Models\AdditionalOption;
use App\Models\Admin;
use App\Models\JobRequest;
use App\Models\MCommissionRate;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductQuestion;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** 実行したいSeederをここに登録 */
    private const SEEDERS = [
        PrefectureSeeder::class,
        MProductCategorySeeder::class,
        MProductChildCategorySeeder::class,
        MCommissionRateSeeder::class,
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
            'name'  => '管理者',
            'email' => 'admin@test.com',
        ]);
        foreach (self::SEEDERS as $seeder) {
            $this->call($seeder);
        }

        // 指定の開発環境のみ実行
        if (\in_array(config('app.env'), ['local', 'development', 'stage'], true)) {
            // 開発ログイン用
            User::factory()
                ->has(UserProfile::factory()->approved()->count(1)) // 承認済み
                ->has(
                    Product::factory()                    // サービス投稿
                        ->has(ProductImage::factory()->count(3)) // 画像
                        ->has(AdditionalOption::factory()->count(3)) // 追加オプション
                        ->has(ProductQuestion::factory()->count(3))  // よくある質問
                        ->count(30)
                )
                ->has(JobRequest::factory()->count(30)) // サービスリクエスト投稿
                ->create();
            UserProfile::factory(9)->create();
        }
    }
}
