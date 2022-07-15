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
        Schema::create('user_careers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name')->comment('経歴名')->nullable();
            $table->integer('first_year')->comment('在籍期間開始時の年');
            $table->integer('first_month')->comment('在籍期間開始時の月');
            $table->integer('last_year')->comment('在籍期間終了時の年')->nullable();
            $table->integer('last_month')->comment('在籍期間終了時の月')->nullable();
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
        Schema::dropIfExists('user_careers');
    }
};
