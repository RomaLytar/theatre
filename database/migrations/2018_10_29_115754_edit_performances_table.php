<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->dropColumn('scene');
            $table->integer('hall_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->foreign('hall_id')->references('id')
                ->on('halls')->onDelete('cascade');
        });

        Schema::table('performance_calendars', function (Blueprint $table) {
            $table->dropColumn('event_type');
            $table->integer('hall_price_pattern_id')->unsigned()->nullable();
            $table->boolean('isSoldInCashBox')->default(false);
            $table->boolean('isSoldOnline')->default(false);
            $table->boolean('areTicketsGenerated')->default(false);
            $table->softDeletes();

            $table->foreign('hall_price_pattern_id')->references('id')
                ->on('hall_price_patterns')->onDelete('cascade');
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
            $table->dropForeign(['hall_price_pattern_id']);

            $table->dropSoftDeletes();
            $table->dropColumn('areTicketsGenerated')->default(false);
            $table->dropColumn('isSoldOnline')->default(false);
            $table->dropColumn('isSoldInCashBox')->default(false);
            $table->dropColumn('hall_price_pattern_id');

            $table->enum('event_type', [
                'opera', 'ballet', 'concert', 'children', 'tour', 'festival', 'muzhab'
            ])->default('opera');
        });

        Schema::table('performances', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropForeign(['hall_id']);
            $table->dropColumn('hall_id');

            $table->enum('scene', ['big', 'small', 'open', 'chamber', 'loft']);
        });
    }
}
