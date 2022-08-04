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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('payjp_charge_id')->comment('Payjpのcharge_id');
            $table->integer('amount')->comment('支払い金額');
            $table->integer('amount_refunded')->comment('返金金額')->nullable();
            $table->datetime('refunded_at')->comment('返金完了日時')->nullable();
            $table->datetime('refunded_failed_at')->comment('返金失敗日時')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
