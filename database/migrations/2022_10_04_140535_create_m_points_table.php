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
        Schema::create('m_points', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('タイトル');
            $table->integer('point')->comment('ポイント数');
            $table->integer('deadline_period')->comment('有効期間(月)');
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
        Schema::dropIfExists('m_points');
    }
};
