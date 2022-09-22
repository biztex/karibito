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
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->unsignedInteger("reference_id")->after('user_id'); // reference_id, reference_typeを作成
            $table->string("reference_type")->after('reference_id');
            $table->index(["reference_id", "reference_type"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_notification_tables', function (Blueprint $table) {
            $table->dropColumn('reference_type');
            $table->dropColumn('reference_id');
        });
    }
};
