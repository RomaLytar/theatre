<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemToActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('actors', function (Blueprint $table) {
        $table->integer('group_id')->unsigned();
        $table->foreign('group_id')->references('id')
          ->on('actor_groups')
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
      Schema::table('actors', function (Blueprint $table) {
        $table->dropForeign(['group_id']);
      });
    }
}
