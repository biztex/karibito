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
        Schema::create('transfer_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('amount')->comment('申請金額');
            $table->datetime('requested_at')->comment('振込申請日');
            $table->datetime('completed_at')->comment('振込完了日')->nullable();
            $table->datetime('failed_at')->comment('振込失敗日')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1.申請受付 2.振込完了 3.振込失敗');
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
        Schema::dropIfExists('transfer_requests');
    }
};
