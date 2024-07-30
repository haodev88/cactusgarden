<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->mediumText("slug");
            $table->integer("parent_id");
            $table->string('property')->nullable();
            $table->integer('order_by');
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
        Schema::drop('dt_categorys');
    }
}
