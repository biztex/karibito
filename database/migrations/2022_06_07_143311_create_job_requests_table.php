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
        Schema::create('job_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('product_categories')->cascadeOnDelete()->nullable();
            $table->foreignId('prefecture_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('title')->comment('タイトル')->nullable();
            $table->text('content')->comment('詳細')->nullable();
            $table->integer('price')->comment('金額')->nullable();
            $table->date('application_deadline')->comment('応募期限')->nullable();
            $table->date('required_date')->comment('納期希望日')->nullable();
            $table->boolean('is_online')->comment('1.オンライン 2.オフライン')->nullable();
            $table->boolean('is_call')->comment('1.電話受付可 2.電話受付不可')->nullable();
            $table->boolean('is_draft')->comment('1.下書き 2.下書きではない');
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
        Schema::dropIfExists('job_requests');
    }
};
