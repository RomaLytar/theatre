<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFestivalTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('festival_id')->unsigned();
          $table->string('language', 45);
          $table->string('title', 45);
          $table->string('slug')->unique();
          $table->text('descriptions');
          $table->text('invited_stars')->nullable();
          $table->string('seo_title')->nullable();
          $table->string('seo_description')->nullable();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('festival_id')->references('id')
            ->on('festivals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('festival_translations', function (Blueprint $table) {
          $table->dropForeign([
            'festival_id'
          ]);
        });
        Schema::dropIfExists('festival_translations');
    }
}
