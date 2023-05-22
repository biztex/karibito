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
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION." where status = ".\App\Models\Chatroom::STATUS_CANCELED);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION." where status = ".\App\Models\Chatroom::STATUS_CANCELED_REPORT);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_CANCELED." where status = ".\App\Models\Chatroom::STATUS_COMPLETE);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_COMPLETE." where status = ".\App\Models\Chatroom::STATUS_SELLER_EVALUATION);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_SELLER_EVALUATION." where status = ".\App\Models\Chatroom::STATUS_BUYER_EVALUATION);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_BUYER_EVALUATION." where status = ".\App\Models\Chatroom::STATUS_WORK_REPORT);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_WORK_REPORT." where status = ".\App\Models\Chatroom::STATUS_BUYER_EVALUATION);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_BUYER_EVALUATION." where status = ".\App\Models\Chatroom::STATUS_SELLER_EVALUATION);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_SELLER_EVALUATION." where status = ".\App\Models\Chatroom::STATUS_COMPLETE);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_COMPLETE." where status = ".\App\Models\Chatroom::STATUS_CANCELED);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_CANCELED_REPORT." where status = ".\App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION);
        DB::statement("UPDATE chatrooms SET status = ".\App\Models\Chatroom::STATUS_CANCELED." where status = ".\App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION);
    }
};
