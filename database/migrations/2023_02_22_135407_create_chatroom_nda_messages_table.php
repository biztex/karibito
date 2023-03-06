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
        Schema::create('chatroom_nda_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('send_user_id')->constrained('users')->comment('先に送信したユーザーのID');
            $table->foreignId('chatroom_id')->constrained('chatrooms')->comment('サービスやり取りID');
            $table->text('text')->comment('本文');
            $table->tinyInteger('status')->default(1)->comment('1.受信者確認中, 2.送信者確認中, 3.締結');
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
        Schema::dropIfExists('chatroom_nda_messages');
    }
};
