<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_blog', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title",150);
            $table->string("slug",150);
            $table->string("image",200)->nullable();
            $table->text("short_desc")->nullable();
            $table->text("content");
            $table->string("author",40);
            $table->addColumn('tinyInteger','active',['lenght'=>2,'default'=>0]);
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
        Schema::drop('dt_blog');
    }
}
