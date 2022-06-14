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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('m_product_child_categories')->cascadeOnDelete()->nullable();
            $table->foreignId('prefecture_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('title')->comment('タイトル')->nullable();
            $table->text('content')->comment('詳細')->nullable();
            $table->integer('price')->comment('金額')->nullable();
            $table->boolean('is_online')->comment('0.オンライン 1.オフライン')->nullable();
            $table->integer('number_of_day')->comment('所要時間')->nullable();
            $table->boolean('is_call')->comment('0.電話受付可 1.電話受付不可')->nullable();
            $table->integer('number_of_sale')->comment('販売個数')->nullable();
            $table->boolean('is_draft')->comment('0.下書き 1.下書きではない');
            $table->tinyInteger('status')->comment('1.公開 2.非公開');
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
        Schema::dropIfExists('products');
    }
};
