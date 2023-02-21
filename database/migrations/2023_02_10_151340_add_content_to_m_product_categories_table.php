<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_product_categories', function (Blueprint $table) {
            $table->string('content')->nullable()->after('name')->comment('カテゴリ説明');
            $table->string('banner_image_path')->nullable()->after('content')->comment('バナー画像のパス');
            $table->string('top_image_path')->nullable()->after('banner_image_path')->comment('トップページおすすめカテゴリのアイコン画像のパス');
            $table->string('other_image_path')->nullable()->after('top_image_path')->comment('その他サービスから探す項目のアイコン画像のパス');
        });
        Schema::table('m_product_child_categories', function (Blueprint $table) {
            $table->string('index_image_path')->nullable()->after('name')->comment('カテゴリ一覧に使用されるアイコン画像のパス');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_product_categories', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->dropColumn('banner_image_path');
            $table->dropColumn('top_image_path');
            $table->dropColumn('other_image_path');
        });
        Schema::table('m_product_child_categories', function (Blueprint $table) {
            $table->dropColumn('index_image_path');
        });
    }
};
