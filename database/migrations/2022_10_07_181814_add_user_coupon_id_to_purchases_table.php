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
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('user_coupon_id')->nullable()->after('proposal_id')->constrained()->comment('利用したクーポンのID');
            $table->foreignId('user_use_point_id')->nullable()->after('user_coupon_id')->constrained()->comment('利用したポイントのID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('user_coupon_id');
            $table->dropColumn('user_use_point_id');
        });
    }
};
