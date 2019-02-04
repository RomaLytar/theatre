<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_albums', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('actor_id')->unsigned();
          $table->integer('album_id')->unsigned();
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();

          $table->foreign('actor_id')->references('id')
            ->on('actors')->onDelete('cascade');
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
        Schema::table('actor_albums', function (Blueprint $table) {
          $table->dropForeign(['actor_id']);
          $table->dropForeign(['album_id']);
        });
        Schema::dropIfExists('actor_albums');
    }
}
