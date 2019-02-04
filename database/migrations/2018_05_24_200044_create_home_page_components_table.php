<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePageComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_components', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['recommended', 'specialProjects', 'promoSlider', 'promoSliderMini']);
            $table->integer('performance_calendar_id')->unsigned();
            $table->timestamps();

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
        Schema::table('home_page_components', function (Blueprint $table) {
            $table->dropForeign([
              'performance_calendar_id'
            ]);
        });
        Schema::dropIfExists('home_page_components');
    }
}
