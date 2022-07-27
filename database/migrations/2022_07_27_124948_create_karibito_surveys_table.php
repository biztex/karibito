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
        Schema::create('karibito_surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique();
            $table->integer('star')->comment('5段階評価');
            $table->text('comment')->comment('コメント')->nullable();
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
        Schema::dropIfExists('karibito_surveys');
    }
};
