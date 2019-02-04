<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbookTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebook_translations', function (Blueprint $table) {
            $table->increments('id');
          $table->integer('ebook_id')->unsigned();
          $table->string('language', 10);
          $table->string('title');
          $table->string('file', 255)->nullable();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('ebook_id')->references('id')
            ->on('ebooks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ebook_translations', function (Blueprint $table) {
        $table->dropForeign([
          'ebook_id'
        ]);
      });
        Schema::dropIfExists('ebook_translations');
    }
}
