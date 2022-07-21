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
        Schema::create('dmrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_user_id')->constrained('users')->comment('送信ユーザー');
            $table->foreignId('to_user_id')->constrained('users')->comment('受信ユーザー');
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
        Schema::dropIfExists('dmrooms');
    }
};
