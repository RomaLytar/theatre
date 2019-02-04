<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('project_id')->unsigned();
          $table->string('language', 10);
          $table->text('title');
          $table->text('description');
          $table->string('slug')->unique();
          $table->string('seo_title')->nullable();
          $table->string('seo_description')->nullable();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('project_id')->references('id')
            ->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('project_translations', function (Blueprint $table) {
        $table->dropForeign([
          'project_id'
        ]);
      });
        Schema::dropIfExists('project_translations');
    }
}
