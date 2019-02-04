<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('menu_id')->unsigned();
          $table->string('language', 10);
          $table->string('menu', 100);
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();
  
          $table->foreign('menu_id')->references('id')
            ->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_translations', function (Blueprint $table) {
          $table->dropForeign([
            'menu_id'
          ]);
        });
        Schema::dropIfExists('menu_translations');
    }
}
