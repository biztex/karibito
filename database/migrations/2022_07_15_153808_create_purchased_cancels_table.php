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
        Schema::create('purchased_cancels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->comment('購入ID')->constrained();
            $table->foreignId('user_id')->comment('キャンセル申請したユーザーID')->constrained();
            $table->boolean('reason1')->default(0)->comment('重複購入');
            $table->boolean('reason2')->default(0)->comment('連絡不可');
            $table->boolean('reason3')->default(0)->comment('購入者都合');
            $table->boolean('reason4')->default(0)->comment('出品者都合');
            $table->boolean('reason5')->default(0)->comment('スケジュール');
            $table->boolean('reason6')->default(0)->comment('その他');
            $table->text('text')->comment('キャンセル申請理由詳細');
            $table->tinyInteger('status')->default(1)->comment('1:申請中 2:成立 3:異議申し立て');
            $table->date('cancel_date')->nullable()->comment('キャンセル成立日');
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
        Schema::dropIfExists('purchased_cancels');
    }
};
