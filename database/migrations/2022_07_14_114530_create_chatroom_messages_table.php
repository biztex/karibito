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
        Schema::create('chatroom_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chatroom_id')->comment('サービスやり取りID')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->comment('コメントユーザーID')->constrained('users');
            $table->text('text')->comment('本文')->nullable();
            $table->string('file_name')->comment('画像名')->nullable();
            $table->string('file_path')->comment('画像ファイルパス')->nullable();
            $table->nullableMorphs('reference'); // reference_id, reference_typeを作成
            $table->boolean('is_complete_message')->default(0)->comment('作業完了メッセージフラグ(1.購入完了メッセージ)');
            $table->boolean('is_view')->default(0)->comment('0:未読,1:既読');
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
        Schema::dropIfExists('chatroom_messages');
    }
};
