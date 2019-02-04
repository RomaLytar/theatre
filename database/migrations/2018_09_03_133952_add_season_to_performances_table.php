<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeasonToPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('performances', function (Blueprint $table) {
        $table->integer('season_id')->unsigned()->nullable();
        $table->foreign('season_id')->references('id')
          ->on('seasons')
          ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('performances', function (Blueprint $table) {
        $table->dropForeign(['season_id']);
        $table->dropColumn('season_id');
      });
    }
}
