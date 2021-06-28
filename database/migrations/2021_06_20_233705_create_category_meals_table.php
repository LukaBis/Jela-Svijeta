<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_meals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('categroy_id');
            $table->foreign('categroy_id')->references('id')->on('categories');

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
        Schema::dropIfExists('category_meals');
    }
}
