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
            $table->string('identification_path')->nullable()->after('cover')->comment('身分証明証のパス');
            $table->boolean('is_identify')->after('identification_path')->default(0)->comment('身分証明証の承認フラグ');
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
            $table->dropColumn('identification_path');
            $table->dropColumn('is_identify');
        });
    }
};
