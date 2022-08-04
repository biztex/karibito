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
        Schema::create('user_get_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('ユーザーID');
            $table->foreignId('reference_id')->constrained('m_point_rates')->comment('参照テーブルID')->nullable();
            $table->string('reference_type')->comment('参照テーブルタイプ')->nullable();
            $table->string('name')->comment('タイトル');
            $table->integer('point')->comment('取得ポイント');
            $table->date('deadline')->comment('有効期限');
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
        Schema::dropIfExists('user_get_points');
    }
};
