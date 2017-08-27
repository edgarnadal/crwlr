<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_categories', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('store_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('store_categories');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('page_id')->references('id')->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_categories');
    }
}
