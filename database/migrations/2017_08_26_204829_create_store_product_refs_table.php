<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProductRefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_product_refs', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('store_product_id')->unsigned();
            $table->integer('ref_store_product_id')->unsigned();
            $table->timestamps();

            $table->foreign('store_product_id')->references('id')->on('store_products');
            $table->foreign('ref_store_product_id')->references('id')->on('store_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_product_refs');
    }
}
