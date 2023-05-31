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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('view_count')->default(0)->after('is_draft')->comment('表示回数');
        });
        Schema::table('job_requests', function (Blueprint $table) {
            $table->integer('view_count')->default(0)->after('is_draft')->comment('表示回数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('view_count');
        });
        Schema::table('job_requests', function (Blueprint $table) {
            $table->dropColumn('view_count');
        });
    }
};
