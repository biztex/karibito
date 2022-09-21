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
        Schema::create('purchased_product_youtube_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchased_product_id')->constrained()->cascadeOnDelete();
            $table->string('youtube_link')->comment('YouTubeのリンク');
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
        Schema::dropIfExists('purchased_product_youtube_links');
    }
};
