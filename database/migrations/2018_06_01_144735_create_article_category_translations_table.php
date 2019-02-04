<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_category_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('article_category_id')->unsigned();
          $table->string('language', 10);
          $table->string('title', 100);
          $table->string('slug')->unique();
          $table->string('seo_title')->nullable();
          $table->string('seo_description')->nullable();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('article_category_id')->references('id')
            ->on('article_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_category_translations', function (Blueprint $table) {
          $table->dropForeign([
            'article_category_id'
          ]);
        });
        Schema::dropIfExists('article_category_translations');
    }
}
