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
            $table->integer("purchased_reference_id")->nullable()->after('reference_id'); // reference_id, reference_typeを作成
            $table->string("purchased_reference_type")->nullable()->after('purchased_reference_id');
            $table->index(["purchased_reference_id", "purchased_reference_type"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chatroom', function (Blueprint $table) {
            $table->dropColumn('reference_type');
            $table->dropColumn('reference_id');
        });
    }
};
