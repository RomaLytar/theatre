<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemToPerformanceActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('performance_actors', function (Blueprint $table) {
        $table->integer('actor_role_id')->unsigned()->nullable();

        $table->foreign('actor_role_id')->references('id')
          ->on('actor_roles')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('performance_actors', function (Blueprint $table) {
        $table->dropForeign([
          'actor_role_id'
        ]);
      });
    }
}
