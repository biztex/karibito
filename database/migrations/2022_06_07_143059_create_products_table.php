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
            $table->foreignId('category_id')->constrained('product_categories')->cascadeOnDelete();
            $table->foreignId('prefecture_id')->constrained()->cascadeOnDelete()->nullable();;
            $table->string('title')->comment('タイトル')->nullable();
            $table->string('content')->comment('内容')->nullable();
            $table->integer('price')->comment('金額')->nullable();
            $table->boolean('is_online')->comment('')->nullable();
            $table->integer('number_of_day')->comment('所要時間')->nullable();
            $table->boolean('is_call')->comment('')->nullable();
            $table->integer('number_of_sale')->comment('')->nullable();
            $table->boolean('is_draft')->comment(''); //下書きか否か
            $table->tinyInteger('status')->comment('');
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
