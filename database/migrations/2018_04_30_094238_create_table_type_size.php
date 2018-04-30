<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTypeSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_types', function (Blueprint $table){
            $table->increments('id');
            $table->string('title',50);
            $table->string('slug',100);
            $table->timestamps();
        });
        Schema::table('sizes', function (Blueprint $table){
            $table->unsignedInteger('size_type_id')->after('name');
            $table->foreign('size_type_id')->references('id')->on('size_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
