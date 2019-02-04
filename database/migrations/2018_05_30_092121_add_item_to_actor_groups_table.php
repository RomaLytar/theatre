<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemToActorGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('actor_groups', function (Blueprint $table) {
        $table->integer('parent_id')->nullable()->unsigned();
        $table->foreign('parent_id')->references('id')
          ->on('actor_groups')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('actor_groups', function (Blueprint $table) {
        $table->dropForeign(['parent_id']);
      });
    }
}
