<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('performance_id')->unsigned();
            $table->string('language', 45);
            $table->string('title', 100);
            $table->string('slug')->unique();
            $table->text('descriptions');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('performance_id')->references('id')
              ->on('performances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_translations', function (Blueprint $table) {
            $table->dropForeign([
              'performance_id'
            ]);
        });
        Schema::dropIfExists('performance_translations');
    }
}
