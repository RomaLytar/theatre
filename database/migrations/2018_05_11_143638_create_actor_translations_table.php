<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actor_id')->unsigned();
            $table->string('language', 45);
            $table->string('firstName', 45);
            $table->string('lastName', 45);
            $table->string('slug')->unique();
            $table->text('descriptions');
            $table->string('degree', 45);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('actor_id')->references('id')
              ->on('actors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actor_translations', function (Blueprint $table) {
            $table->dropForeign([
              'actor_id'
            ]);
        });
        Schema::dropIfExists('actor_translations');
    }
}
