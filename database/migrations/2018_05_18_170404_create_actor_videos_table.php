<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actor_id')->unsigned();
            $table->integer('video_id')->unsigned();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('actor_id')->references('id')
                ->on('actors')->onDelete('cascade');
            $table->foreign('video_id')->references('id')
                ->on('videos')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actor_videos', function (Blueprint $table) {
            $table->dropForeign(['actor_id']);
            $table->dropForeign(['video_id']);
        });
        Schema::dropIfExists('actor_videos');   
    }
}
