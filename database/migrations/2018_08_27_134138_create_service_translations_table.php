<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('service_id')->unsigned();
          $table->string('language', 10);
          $table->string('title');
          $table->text('description');
          $table->string('seo_title')->nullable();
          $table->string('seo_description')->nullable();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();
          $table->foreign('service_id')->references('id')
            ->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('service_translations', function (Blueprint $table) {
        $table->dropForeign([
          'service_id'
        ]);
      });
        Schema::dropIfExists('service_translations');
    }
}
