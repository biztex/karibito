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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('path')->comment('写真のパス');
            $table->foreignId('category_id')->nullable()->constrained('m_product_child_categories');
            $table->string('title')->comment('タイトル')->nullable();
            $table->text('detail')->comment('詳細')->nullable();
            $table->integer('year')->comment('制作した年');
            $table->integer('month')->comment('制作した月');
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
        Schema::dropIfExists('portfolios');
    }
};
