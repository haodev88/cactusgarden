<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',80)->nullable();
            $table->string('code',30);
            $table->string('slug');
            $table->text('content')->nullable();
            $table->addColumn('tinyInteger','status',
                [
                    'lenght'=>2,
                    'nullable'=>true,
                    'default' =>0
                ]
            );
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
        Schema::drop('dt_page');
    }
}
