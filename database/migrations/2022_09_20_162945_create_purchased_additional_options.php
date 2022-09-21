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
        Schema::create('purchased_additional_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchased_product_id')->constrained()->cascadeOnDelete();
            $table->string('name')->comment('オプション名')->nullable();
            $table->integer('price')->comment('金額')->nullable();
            $table->boolean('is_public')->comment('0.非公開 1.公開');
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
        Schema::dropIfExists('purchased_additional_options');
    }
};
