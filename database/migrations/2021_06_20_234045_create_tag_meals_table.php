<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_tag', function (Blueprint $table) {
          $table->id();

          $table->unsignedBigInteger('tag_id');
          $table->foreign('tag_id')->references('id')->on('tags');

          $table->unsignedBigInteger('meal_id');
          $table->foreign('meal_id')->references('id')->on('meals');

          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_meals');
    }
}
