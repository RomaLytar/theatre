<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorGroupTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_group_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('actor_group_id')->unsigned();
          $table->string('language', 45);
          $table->string('title', 45);
          $table->string('slug')->unique();
          $table->string('seo_title')->nullable();
          $table->string('seo_description')->nullable();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('actor_group_id')->references('id')
            ->on('actor_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actor_group_translations', function (Blueprint $table) {
          $table->dropForeign([
            'actor_group_id'
          ]);
        });
        Schema::dropIfExists('actor_group_translations');
    }
}
