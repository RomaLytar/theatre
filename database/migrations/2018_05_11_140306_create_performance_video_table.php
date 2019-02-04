<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('performance_id')->unsigned();
            $table->integer('video_id')->unsigned();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('performance_id')->references('id')
              ->on('performances')->onDelete('cascade');
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
        Schema::table('performance_videos', function (Blueprint $table) {
            $table->dropForeign(['performance_id']);
            $table->dropForeign(['video_id']);
        });
        Schema::dropIfExists('performance_videos');
    }
}
