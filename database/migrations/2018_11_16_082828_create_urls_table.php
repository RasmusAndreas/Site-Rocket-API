<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('url');
            $table->boolean('excludeLoadtimes')->default(false);
            $table->decimal('htmlToText', 5, 2);
            $table->integer('wordCount');
            $table->integer('metaDescription');
            $table->integer('altText');
            $table->integer('title');
            $table->integer('h1');
            $table->integer('h2');
            $table->integer('h3');
            $table->integer('h4');
            $table->integer('h5');
            $table->integer('h6');
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
        Schema::dropIfExists('urls');
    }
}
