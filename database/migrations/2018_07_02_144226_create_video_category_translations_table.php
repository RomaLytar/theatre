<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_category_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('video_category_id')->unsigned();
          $table->string('language');
          $table->string('title');
          $table->string('slug')->unique();
          $table->string('seo_title')->nullable();
          $table->string('seo_description')->nullable();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();
          $table->foreign('video_category_id')->references('id')
            ->on('video_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_category_translations', function (Blueprint $table) {
          $table->dropForeign([
            'video_category_id'
          ]);
        });
        Schema::dropIfExists('video_category_translations');
    }
}
