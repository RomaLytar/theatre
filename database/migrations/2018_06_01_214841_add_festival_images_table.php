<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFestivalImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('festival_id')->unsigned();
            $table->integer('image_id')->unsigned();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('festival_id')->references('id')
              ->on('festivals')->onDelete('cascade');
            $table->foreign('image_id')->references('id')
              ->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('festival_images', function (Blueprint $table) {
          $table->dropForeign(['festival_id']);
          $table->dropForeign(['image_id']);
        });
        Schema::dropIfExists('festival_images');
    }
}
