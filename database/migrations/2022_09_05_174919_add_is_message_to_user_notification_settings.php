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
        Schema::table('user_notification_settings', function (Blueprint $table) {
            $table->boolean('is_like')->default(1)->comment('自分の商品がお気に入りに追加された時 0.オフ 1.オン')->change();
            $table->boolean('is_news')->default(1)->comment('お知らせ・ニュース・プロモーションが発信された時 0.オフ 1.オン')->change()->after('is_like');
            $table->boolean('is_message')->default(1)->comment('チャットメッセージが更新された時 0.オフ 1.オン')->after('is_news');
            $table->boolean('is_posting')->default(1)->comment('フォローしている人がポートフォリオ、ブログをアップした時 0.オフ 1.オン')->change()->after('is_message');
            $table->boolean('is_fav')->default(1)->comment('自分がお気に入りした商品が更新された時 0.オフ 1.オン')->change()->after('is_posting');
            $table->dropColumn('is_arrival');
            $table->dropColumn('is_promo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_notification_settings', function (Blueprint $table) {
            $table->dropColumn('is_message');
        });
    }
};
