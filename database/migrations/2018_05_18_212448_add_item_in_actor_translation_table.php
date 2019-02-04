<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemInActorTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actor_translations', function (Blueprint $table) {
            $table->string('hometown')->nullable();
            $table->string('debut')->nullable();
            $table->string('merit')->nullable();
            $table->string('repertoire')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actor_translations', function (Blueprint $table) {
            $table->dropColumn('hometown');
            $table->dropColumn('debut');
            $table->dropColumn('merit');
            $table->dropColumn('repertoire');
        });
    }
}
