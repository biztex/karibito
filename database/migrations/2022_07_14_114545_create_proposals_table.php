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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chatroom_id')->constrained()->cascadeOnDelete()->comment('サービスやり取りID');
            $table->foreignId('user_id')->constrained('users')->comment('提案したユーザーID');
            $table->integer('price')->comment('提供価格')->nullable();
            $table->boolean('is_purchase')->default(0)->comment('購入フラグ(0.未購入,1.購入)');
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
        Schema::dropIfExists('proposals');
    }
};
