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
        Schema::table('m_points', function (Blueprint $table) {
            $table->integer('deadline_period')->nullable()->change();
        });
        Schema::table('user_get_points', function (Blueprint $table) {
            $table->date('deadline')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_points', function (Blueprint $table) {
            $table->integer('deadline_period')->nullable(false)->change();
        });
        Schema::table('user_get_points', function (Blueprint $table) {
            $table->integer('deadline')->nullable(false)->change();
        });
    }
};
