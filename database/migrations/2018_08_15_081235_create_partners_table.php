<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('category_id')->unsigned();
          $table->boolean('in_footer')->nullable();
          $table->boolean('is_active')->nullable();
          $table->boolean('is_main')->nullable();
          $table->foreign('category_id')->references('id')
            ->on('partner_categories')
            ->onDelete('cascade');
          $table->timestamp('updated_at')->useCurrent();
          $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
          $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('partners');
    }
}
