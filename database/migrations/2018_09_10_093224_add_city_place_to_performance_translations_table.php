<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityPlaceToPerformanceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performance_translations', function (Blueprint $table) {
            $table->string('city')->nullable();
            $table->string('place')->nullable();
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
            $table->dropColumn('city');
            $table->dropColumn('place');
        });
    }
}
