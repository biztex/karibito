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
        Schema::create('dmroom_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dmroom_id')->constrained()->cascadeOnDelete()->comment('DMやり取りID');
            $table->foreignId('user_id')->constrained('users')->comment('コメントユーザーID');
            $table->text('text')->comment('本文')->nullable();
            $table->string('file_name')->comment('画像名')->nullable();
            $table->string('file_path')->comment('画像ファイルパス')->nullable();
            $table->boolean('is_view')->default(0)->comment('相手がメッセージを見たかどうか,0:未読1:既読)');
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
        Schema::dropIfExists('dmroom_messages');
    }
};
