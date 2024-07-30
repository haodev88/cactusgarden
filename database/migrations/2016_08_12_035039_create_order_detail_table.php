<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dt_order_id');
            $table->integer('dt_brand_id');
            $table->integer('dt_supplier_id');
            $table->integer('dt_product_id');
            $table->string('sku',20);
            $table->string('product_name');
            $table->decimal('quanlity',10,0);
            $table->decimal('price', 10,0);
            $table->text('attribute');
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
        Schema::drop('dt_order_details');
    }
}
