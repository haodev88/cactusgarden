<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dt_order_status_id');
            $table->integer('dt_customer_id')->unsigned();
            $table->char('order_code',10);
            $table->text('order_note')->nullable();
            $table->decimal('fee_shipping',10);
            $table->decimal('total_amount',10);
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
        Schema::drop('dt_orders');
    }
}
