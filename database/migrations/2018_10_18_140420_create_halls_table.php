<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('hall_plans', 'halls');
        Schema::table('halls', function (Blueprint $table) {
            $table->string('name', 50);
            $table->string('patternPath')->nullable();
        });

        Schema::rename('hall_plan_translations', 'hall_translations');

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->integer('hall_id')->unsigned();
            $table->timestamps();
            $table->foreign('hall_id')->references('id')
                ->on('halls')->onDelete('cascade');
        });

        Schema::create('section_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned();
            $table->string('language', 10);
            $table->string('title');
            $table->timestamps();
            $table->foreign('section_id')->references('id')
                ->on('sections')->onDelete('cascade');
        });

        Schema::create('rows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->integer('section_id')->unsigned();
            $table->timestamps();
            $table->foreign('section_id')->references('id')
                ->on('sections')->onDelete('cascade');
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->boolean('recommended');
            $table->integer('row_id')->unsigned();
            $table->timestamps();
            $table->foreign('row_id')->references('id')
                ->on('rows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seats', function (Blueprint $table) {
            $table->dropForeign(['row_id']);
        });
        Schema::dropIfExists('seats');

        Schema::table('rows', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
        });
        Schema::dropIfExists('rows');

        Schema::table('section_translations', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
        });
        Schema::dropIfExists('section_translations');

        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign(['hall_id']);
        });
        Schema::dropIfExists('sections');

        Schema::rename('hall_translations', 'hall_plan_translations');

        Schema::table('halls', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('patternPath');
        });
        Schema::rename('halls', 'hall_plans');
    }
}
