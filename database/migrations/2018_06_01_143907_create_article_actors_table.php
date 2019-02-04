<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_actors', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('article_id')->unsigned();
          $table->integer('actor_id')->unsigned();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();
  
          $table->foreign('article_id')->references('id')
            ->on('articles')->onDelete('cascade');
          $table->foreign('actor_id')->references('id')
            ->on('actors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_actors', function (Blueprint $table) {
          $table->dropForeign(['article_id']);
          $table->dropForeign(['actor_id']);
        });
        Schema::dropIfExists('article_actors');
    }
}
