<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('dt_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dt_provinceid',5);
            $table->string('dt_districtid',5);
            $table->string('dt_wardid',5);
            $table->string('name',200);
            $table->tinyInteger('gender')->nullable(0);
            $table->string('address',255);
            $table->string('email');
            $table->string('password',255);
            $table->char('phone',20);
            $table->dateTime('birthday');
            $table->timestamps();
            $table->string('check_sum',80);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('dt_customers');
    }
}
