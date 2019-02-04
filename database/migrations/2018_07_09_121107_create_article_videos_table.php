<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleVideosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('article_videos', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('article_id')->unsigned();
      $table->integer('video_id')->unsigned();
      $table->timestamp('updated_at')->useCurrent();
      $table->timestamp('created_at')->useCurrent();

      $table->foreign('article_id')->references('id')
        ->on('articles')->onDelete('cascade');
      $table->foreign('video_id')->references('id')
        ->on('videos')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('article_videos', function (Blueprint $table) {
      $table->dropForeign(['article_id']);
      $table->dropForeign(['video_id']);
    });
    Schema::dropIfExists('article_videos');
  }
}
