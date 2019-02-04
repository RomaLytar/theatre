<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemInPerformanceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('performance_translations', function (Blueprint $table) {
        $table->text('synapsis')->nullable();
        $table->string('program')->nullable();
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
        $table->dropColumn('synapsis');
        $table->dropColumn('program');
      });
    }
}
