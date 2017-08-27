<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('store_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->integer('store_category_id')->unsigned();
            $table->integer('product_id')->unsigned()->nullable();

            $table->string('name');
            $table->text('description')->nullable();
            $table->text('picture_url')->nullable();
            $table->string('price');
            $table->float('parsed_price')->nullable();

            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('page_id')->references('id')->on('pages');
            $table->foreign('store_category_id')->references('id')->on('store_categories');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_products');
    }
}
