<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsSizesImagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('sizes', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('images', function(Blueprint $table){
            $table->increments('id');
            $table->string('url');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('color_product', function(Blueprint $table){
            $table->unsignedInteger('color_id');
            $table->unsignedInteger('product_id');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('size_product', function(Blueprint $table){
            $table->unsignedInteger('size_id');
            $table->unsignedInteger('product_id');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('images');
    }
}
