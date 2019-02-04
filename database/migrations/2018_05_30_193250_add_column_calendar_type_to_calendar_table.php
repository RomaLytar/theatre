<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCalendarTypeToCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performance_calendars', function (Blueprint $table) {
            $table->enum('event_type', [
              'opera', 'ballet', 'concert', 'children', 'tour', 'festival', 'muzhab'
              ])->default('opera');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_calendars', function (Blueprint $table) {
            $table->dropColumn('event_type');
        });
    }
}
