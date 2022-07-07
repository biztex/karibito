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
        Schema::create('job_request_chatrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_request_id')->constrained()->cascadeOnDelete()->comment('サービスリクエストID');
            $table->foreignId('seller_user_id')->constrained('users')->comment('販売側ユーザー');
            $table->foreignId('buyer_user_id')->constrained('users')->comment('購入側ユーザー');
            $table->tinyInteger('status')->default(1)->comment('1.チャット開始 2.契約 3.作業 4.評価 5.完了 6.キャンセル');
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
        Schema::dropIfExists('job_request_chatrooms');
    }
};
