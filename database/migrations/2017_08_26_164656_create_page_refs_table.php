<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageRefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_refs', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('ref_id')->unsigned();
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('pages');
            $table->foreign('ref_id')->references('id')->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_refs');
    }
}
