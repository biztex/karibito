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
        Schema::create('chatrooms', function (Blueprint $table) {
            $table->id();
            $table->morphs('reference'); // reference_id, reference_typeを作成
            $table->foreignId('seller_user_id')->constrained('users')->comment('販売側ユーザー');
            $table->foreignId('buyer_user_id')->constrained('users')->comment('購入側ユーザー');
            $table->tinyInteger('status')->default(1)->comment('1.チャット開始 2.契約 3.作業 4.購入者評価 5.出品者評価 6.完了 7.キャンセル');
            $table->softDeletes();
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
        Schema::dropIfExists('chatrooms');
    }
};
