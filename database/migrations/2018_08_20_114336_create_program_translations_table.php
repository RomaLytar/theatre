<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('program_translations', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('program_id')->unsigned();
      $table->string('language', 10);
      $table->text('title');
      $table->text('description');
      $table->text('terms_description')->nullable();
      $table->string('seo_title')->nullable();
      $table->string('seo_description')->nullable();
      $table->timestamp('updated_at')->useCurrent();
      $table->timestamp('created_at')->useCurrent();
      $table->foreign('program_id')->references('id')
        ->on('programs')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  { Schema::table('program_translations', function (Blueprint $table) {
    $table->dropForeign([
      'program_id'
    ]);
  });
    Schema::dropIfExists('program_translations');
  }
}