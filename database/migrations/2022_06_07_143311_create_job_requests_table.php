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
            $table->foreignId('category_id')->constrained('product_categories')->cascadeOnDelete();
            $table->foreignId('prefecture_id')->constrained()->cascadeOnDelete();
            $table->string('title')->comment('タイトル')->nullable();
            $table->string('content')->comment('内容')->nullable();
            $table->integer('price')->comment('金額')->nullable();
            $table->date('application_deadline')->comment('応募期限')->nullable();
            $table->date('required_date')->comment('納期希望日')->nullable();
            $table->boolean('is_online')->comment('')->nullable();
            $table->boolean('is_call')->comment('')->nullable();
            $table->boolean('is_draft')->comment('');
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
        Schema::dropIfExists('job_requests');
    }
};
