<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('controllers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('controller_name');
            $table->string('display_name');
        });

        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('controller_id')->unsigned();
            $table->string('action_name');
            $table->string('display_name');
            $table->foreign('controller_id')->references('id')->on('controllers')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('actions');
        Schema::drop('controllers');
    }
}
