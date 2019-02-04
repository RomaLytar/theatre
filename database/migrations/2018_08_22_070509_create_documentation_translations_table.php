<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('doc_id')->unsigned();
          $table->string('language');
          $table->text('title');
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();
          $table->foreign('doc_id')->references('id')
            ->on('docs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('doc_translations', function (Blueprint $table) {
        $table->dropForeign([
          'doc_id'
        ]);
      });
        Schema::dropIfExists('doc_translations');
    }
}
