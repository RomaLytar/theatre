<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_albums', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('performance_id')->unsigned();
          $table->integer('album_id')->unsigned();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('performance_id')->references('id')
            ->on('performances')->onDelete('cascade');
          $table->foreign('album_id')->references('id')
            ->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_albums', function (Blueprint $table) {
          $table->dropForeign(['performance_id']);
          $table->dropForeign(['album_id']);
        });
        Schema::dropIfExists('performance_albums');
    }
}
