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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chatroom_id')->comment('サービスやり取りID')->constrained()->cascadeOnDelete();
            $table->foreignId('proposal_id')->comment('購入した提案ID')->constrained('proposals');
            $table->foreignId('buyer_user_id')->comment('購入したユーザーID')->constrained('users');
            $table->boolean('is_cancel')->default(0)->comment('キャンセルフラグ(1.キャンセル成立)');
            $table->date('cancel_date')->nullable()->comment('キャンセル成立');
            $table->softDeletes();
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
        Schema::dropIfExists('purchases');
    }
};
