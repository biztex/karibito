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
            $table->tinyInteger('trash_flg')->nullable()->comment('1.ゴミ箱');
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
            $table->dropColumn('trash_flg');
        });
    }
};
