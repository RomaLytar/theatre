<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCondDescriptionFromProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('project_translations', function (Blueprint $table) {
        $table->dropColumn('cond_description');
      });
      Schema::table('project_translations', function (Blueprint $table) {
        $table->text('cond_description')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('project_translations', function (Blueprint $table) {
        $table->dropColumn('cond_description');
      });
      Schema::table('project_translations', function (Blueprint $table){
        $table->text('cond_description');
      });
    }
}
