<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('performance_type_id')->unsigned();
            $table->string('language', 45);
            $table->string('title', 45);
            $table->string('slug')->unique();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('performance_type_id')->references('id')
              ->on('performance_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_type_translations', function (Blueprint $table) {
            $table->dropForeign([
              'performance_type_id'
            ]);
        });
        Schema::dropIfExists('performance_type_translations');
    }
}
