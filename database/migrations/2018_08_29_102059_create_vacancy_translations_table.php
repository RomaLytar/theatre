<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('vacancy_id')->unsigned();
          $table->string('language', 10);
          $table->string('title');
          $table->text('description');
          $table->string('seo_title')->nullable();
          $table->string('seo_description')->nullable();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('vacancy_id')->references('id')
            ->on('vacancies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('vacancy_translations', function (Blueprint $table) {
        $table->dropForeign([
          'vacancy_id'
        ]);
      });
        Schema::dropIfExists('vacancy_translations');
    }
}
