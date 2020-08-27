<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('topic_id')->unsigned();
            $table->string('name');
            $table->string('description', 750);
            $table->string('address');
            $table->double('address_long')->nullable();
            $table->double('address_lat')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->double('distance')->nullable();
            $table->string('place_image')->nullable();
            $table->string('place_image_path')->nullable();
            $table->timestamps();
        });

        Schema::table('recommendations', function ($table) {
            $table->foreign('topic_id')->references('id')->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommendations');
    }
}
