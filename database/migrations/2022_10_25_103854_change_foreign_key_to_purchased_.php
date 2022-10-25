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
        Schema::table('purchased_additional_options', function (Blueprint $table) {
            $table->dropForeign('purchased_additional_options_product_id_foreign');
            $table->dropIndex('purchased_additional_options_product_id_foreign');
            $table->foreign('purchased_product_id')->references('id')->on('purchased_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchased_additional_options', function (Blueprint $table) {
            // $table->dropForeign('purchased_additional_options_purchased_product_id_foreign');
            // $table->dropIndex('purchased_additional_options_purchased_product_id_foreign');
            // $table->foreign('purchased_product_id')->references('id')->on('products');
        });
    }
};
