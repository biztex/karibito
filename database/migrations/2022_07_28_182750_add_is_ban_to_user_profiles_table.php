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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->boolean('is_ban')->default(0)->comment('0.制限なし 1.制限あり')->after('can_call');
            $table->timestamp('is_banned_at')->comment('バンした時間')->nullable()->after('is_ban');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('is_ban');
            $table->dropColumn('is_banned_at');
        });
    }
};
