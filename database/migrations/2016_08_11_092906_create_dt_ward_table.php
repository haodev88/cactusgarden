<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDtWardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_wards', function (Blueprint $table) {
            $table->string('wardid',5);
            $table->string('name',100);
            $table->string('type',30);
            $table->string('location',30);
            $table->string('districtid',5);
            $table->primary('wardid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dt_wards');
    }
}
