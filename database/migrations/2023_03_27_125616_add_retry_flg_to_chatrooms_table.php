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
        Schema::table('chatrooms', function (Blueprint $table) {
            $table->tinyInteger('retry_flg')->nullable()->comment('1.リトライ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chatrooms', function (Blueprint $table) {
            $table->dropColumn('retry_flg');
        });
    }
};
