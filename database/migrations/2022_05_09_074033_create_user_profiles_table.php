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
            $table->foreignId('user_id')->constrained();
            $table->string('first_name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->tinyInteger('gender')->nullable(false)->comment('1.男性、2.女性');
            $table->integer('prefecture')->nullable(false);
            $table->date('birthday')->nullable(false);
            $table->string('zip')->nullable(false);
            $table->string('address')->nullable(false);
            $table->text('introduction')->nullable();
            $table->string('icon')->nullable();
            $table->string('cover')->nullable();
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
