<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_performances', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('article_id')->unsigned();
          $table->integer('performance_id')->unsigned();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();
  
          $table->foreign('article_id')->references('id')
            ->on('articles')->onDelete('cascade');
          $table->foreign('performance_id')->references('id')
            ->on('performances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_performances', function (Blueprint $table) {
          $table->dropForeign(['article_id']);
          $table->dropForeign(['performance_id']);
        });
        Schema::dropIfExists('article_performances');
    }
}
