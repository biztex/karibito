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
        if (!Schema::hasColumn('user_profiles', 'address_number')) {
            Schema::table('user_profiles', function (Blueprint $table) {
                $table->string('address_number')->after('address')->nullable();
                $table->string('apartment')->after('address_number')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('address_number');
            $table->dropColumn('apartment');
        });
    }
};
