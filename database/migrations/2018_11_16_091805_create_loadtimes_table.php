<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loadtimes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->decimal('loadtime', 5, 2);
            $table->integer('urlID')->unsigned();
            $table->foreign('urlID')->references('id')->on('urls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loadtimes');
    }
}
