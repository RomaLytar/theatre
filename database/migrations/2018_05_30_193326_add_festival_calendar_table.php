<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFestivalCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_calendars', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('festival_id')->unsigned();
          $table->integer('performance_calendar_id')->unsigned();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('festival_id')->references('id')
            ->on('festivals')->onDelete('cascade');

          $table->foreign('performance_calendar_id')->references('id')
            ->on('performance_calendars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('festival_calendars', function (Blueprint $table) {
          $table->dropForeign(['festival_id']);
          $table->dropForeign(['performance_calendar_id']);
        });
        Schema::dropIfExists('festival_calendars');
    }
}
