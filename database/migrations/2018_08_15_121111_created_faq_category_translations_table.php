<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedFaqCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_category_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('faq_category_id')->unsigned();
          $table->string('language', 10);
          $table->string('title', 100);
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('faq_category_id')->references('id')
            ->on('faq_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('faq_category_translations', function (Blueprint $table) {
      $table->dropForeign([
        'faq_category_id'
      ]);
    });
        Schema::dropIfExists('faq_category_translations');
    }
}
