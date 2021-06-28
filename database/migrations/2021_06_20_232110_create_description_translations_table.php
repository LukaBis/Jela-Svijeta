<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description_translations', function (Blueprint $table) {
          $table->id();

          $table->string('locale')->index();

          $table->unsignedBigInteger('description_id');
          $table->foreign('description_id')->references('id')->on('descriptions')->onDelete('cascade');;

          $table->string("translation");

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
        Schema::dropIfExists('description_translations');
    }
}
