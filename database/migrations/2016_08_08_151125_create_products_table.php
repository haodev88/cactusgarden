<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dt_category_id');
            $table->integer('dt_brand_id')->default(0);
            $table->integer('dt_supplier_id')->default(0);
            $table->integer('user_id');
            $table->string('sku',20);
            $table->string('name');
            $table->string('slug');
            $table->decimal('price',10,0);
            $table->decimal('self_price',10,0)->default(0);
            $table->integer('count')->default(0);
            $table->string('default_image')->nullable();
            $table->mediumText('filename')->nullable();
            $table->mediumText('short_desc')->nullable();
            $table->mediumText('long_desc')->nullable();
            $table->tinyInteger('active')->default(0);
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
        Schema::drop('dt_products');
    }
}
