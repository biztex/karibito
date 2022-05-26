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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('first_name')->nullable()->comment('姓');
            $table->string('last_name')->nullable()->comment('名');
            $table->tinyInteger('gender')->nullable()->comment('1.男性、2.女性');
            $table->foreignId('prefecture_id')->nullable()->constrained()->cascadeOnDelete();
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->string('zip')->nullable()->comment('郵便番号');
            $table->string('address')->nullable()->comment('住所');
            $table->text('introduction')->nullable()->comment('自己紹介');
            $table->string('icon')->nullable()->comment('アイコン画像');
            $table->string('cover')->nullable()->comment('カバー画像');
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
        Schema::dropIfExists('user_profiles');
    }
};
