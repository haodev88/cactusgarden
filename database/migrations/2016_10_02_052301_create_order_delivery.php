<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_order_delivery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dt_order_id')->unsigned();
            $table->string('name_delivery_from');
            $table->string('order_email',50);
            $table->string('phone_delivery_from');
            $table->string('dt_provinceid_from');
            $table->string('dt_districtid_from');
            $table->string('dt_wardid_from');
            $table->string('address_from');
            $table->string('name_delivery_to');
            $table->string('phone_delivery_to');
            $table->string('dt_provinceid_to');
            $table->string('dt_districtid_to');
            $table->string('dt_wardid_to');
            $table->string('address_to');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('dt_order_delivery');
    }
}
