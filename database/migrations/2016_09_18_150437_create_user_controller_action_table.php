<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserControllerActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_controller_action', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('controller_id')->unsigned();
            $table->integer('action_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('controller_id')->references('id')->on('controllers')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('action_id')->references('id')->on('actions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_controller_action');
    }
}
