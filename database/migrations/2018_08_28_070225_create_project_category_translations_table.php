<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_cat_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('project_cat_id')->unsigned();
          $table->string('language', 10);
          $table->string('title', 100);
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('project_cat_id')->references('id')
            ->on('project_cats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('project_cat_translations', function (Blueprint $table) {
        $table->dropForeign([
          'project_cat_id'
        ]);
      });
        Schema::dropIfExists('project_cat_translations');
    }
}
