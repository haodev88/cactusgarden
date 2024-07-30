<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierBrandBuyerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_supplier_brand_buyer', function (Blueprint $table) {
            $table->integer('dt_supplier_id')->unsigned();
            $table->integer('dt_brand_id')->unsigned();
            $table->foreign('dt_supplier_id')->references('id')->on('dt_suppliers')->onDelete("cascade");
            $table->foreign('dt_brand_id')->references('id')->on('dt_brands')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dt_supplier_brand_buyer');
    }
}
