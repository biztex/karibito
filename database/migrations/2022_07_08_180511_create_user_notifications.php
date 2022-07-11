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
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title')->comment('タイトル');
            $table->text('content')->comment('詳細');
            $table->boolean('is_notification')->comment('通知がオンかオフか, 0:オフ,1:オン');
            $table->boolean('is_view')->default(0)->comment('通知を見たかどうか, 0:未読,1:既読');
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
        Schema::dropIfExists('user_notifications');
    }
};
