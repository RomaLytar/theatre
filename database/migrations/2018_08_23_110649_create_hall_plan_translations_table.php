<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallPlanTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_plan_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('hall_id')->unsigned();
          $table->string('language', 10);
          $table->string('title');
          $table->string('description');
          $table->string('seo_title')->nullable();
          $table->string('seo_description')->nullable();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('hall_id')->references('id')
            ->on('hall_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {Schema::table('hall_plan_translations', function (Blueprint $table) {
      $table->dropForeign([
        'hall_id'
      ]);
    });
        Schema::dropIfExists('hall_plan_translations');
    }
}
