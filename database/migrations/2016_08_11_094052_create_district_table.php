<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_districts', function (Blueprint $table) {
            $table->string('districtid',5);
            $table->string('name',100);
            $table->string('type',30);
            $table->string('location',30);
            $table->string('provinceid',5);
            $table->primary('districtid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dt_districts');
    }
}
