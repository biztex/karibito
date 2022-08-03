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
        Schema::create('user_coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('ユーザーID');
            $table->integer('coupon_number')->comment('クーポンナンバー')->unique();
            $table->string('name')->comment('クーポン名');
            $table->string('content')->comment('詳細')->nullable();
            $table->date('deadline')->comment('有効期限');
            $table->integer('discount')->comment('割引金額');
            $table->integer('min_price')->comment('最低利用金額');
            $table->timestamp('used_at')->comment('利用日時')->nullable();
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
        Schema::dropIfExists('user_coupons');
    }
};
