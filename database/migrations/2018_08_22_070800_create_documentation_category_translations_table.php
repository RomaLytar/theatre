<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentationCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doc_category_id')->unsigned();
            $table->string('language', 10);
            $table->string('title', 100);
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('doc_category_id')->references('id')
            ->on('doc_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('doc_category_translations', function (Blueprint $table) {
        $table->dropForeign([
          'doc_category_id'
        ]);
      });
        Schema::dropIfExists('doc_category_translations');
    }
}
