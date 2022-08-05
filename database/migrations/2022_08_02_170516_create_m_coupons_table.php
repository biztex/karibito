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
        Schema::create('m_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('クーポン名');
            $table->string('content')->comment('詳細')->nullable();
            $table->integer('discount')->comment('割引金額');
            $table->integer('min_price')->comment('最低利用金額');
            $table->integer('deadline_period')->comment('有効期間');
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
        Schema::dropIfExists('m_coupons');
    }
};
