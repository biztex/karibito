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
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_like')->default(1)->comment('自分の商品へのいいね 0.オフ 1.オン');
            $table->boolean('is_posting')->default(1)->comment('フォローしている人の掲載 0.オフ 1.オン');
            $table->boolean('is_fav')->default(1)->comment('お気に入り商品の再掲載 0.オフ 1.オン');
            $table->boolean('is_arrival')->default(1)->comment('保存した検索条件の新着 0.オフ 1.オン');
            $table->boolean('is_news')->default(1)->comment('お知らせ・ニュース 0.オフ 1.オン');
            $table->boolean('is_promo')->default(1)->comment('プロモーション 0.オフ 1.オン');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notification_settings');
    }
};
