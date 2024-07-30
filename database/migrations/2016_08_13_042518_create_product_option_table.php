<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('dt_product_options', function (Blueprint $table) {
            $table->integer('dt_product_id')->unsigned();
            $table->integer('dt_option_id')->unsigned();
            $table->foreign('dt_product_id')->references('id')->on('dt_products')->onDelete("cascade");
            $table->foreign('dt_option_id')->references('id')->on('dt_options')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dt_product_options');
    }
}
