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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chatroom_id')->constrained()->cascadeOnDelete()->comment('サービスやり取りID');
            $table->foreignId('user_id')->constrained('users')->comment('評価したユーザーID');
            $table->foreignId('target_user_id')->constrained('users')->comment('評価されたユーザーID');
            $table->double('star',2,1)->comment('評価(5:良い 2.5:普通 1.残念)');
            $table->text('text')->comment('コメント')->nullable();
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
        Schema::dropIfExists('evaluations');
    }
};
