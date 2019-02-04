<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('page_id')->unsigned();
//            $table->string('language', 10);
//            $table->string('title');
//            $table->text('description');
            $table->timestamps();

            $table->foreign('attribute_id')->references('id')
              ->on('attributes')->onDelete('cascade');
            $table->foreign('page_id')->references('id')
              ->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
          $table->dropForeign(['page_id']);
          $table->dropForeign(['attribute_id']);
        });
        Schema::dropIfExists('attribute_values');
    }
}
