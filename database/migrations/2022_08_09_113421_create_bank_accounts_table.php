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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('bank_name')->comment('金融機関名');
            $table->string('bank_code', 4)->comment('銀行コード');
            $table->string('branch_name')->comment('支店名');
            $table->string('branch_code', 4)->comment('支店コード');
            $table->tinyInteger('type')->comment('口座種別 (1:普通, 2:当座)');
            $table->string('name')->comment('口座名義人名');
            $table->string('number')->comment('口座番号');
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
        Schema::dropIfExists('bank_accounts');
    }
};
