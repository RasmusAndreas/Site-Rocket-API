<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUptimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uptimes', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('excludeDowntime')->default(false);
            $table->timestamps();
            $table->integer('statusCode');
            $table->integer('websiteID')->unsigned();
            $table->foreign('websiteID')->references('id')->on('websites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uptimes');
    }
}
