<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('code', 7);
            $table->timestamps();
        });

        Schema::create('price_patterns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('price_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_pattern_id')->unsigned();
            $table->integer('color_id')->unsigned();
            $table->float('price')->default(0);
            $table->boolean('isActive')->default(false);
            $table->timestamps();
            $table->foreign('color_id')->references('id')
                ->on('colors')->onDelete('cascade');
            $table->foreign('price_pattern_id')->references('id')
                ->on('price_patterns')->onDelete('cascade');
        });

        Schema::create('hall_price_patterns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->integer('hall_id')->unsigned();
            $table->integer('price_pattern_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('hall_id')->references('id')
                ->on('halls')->onDelete('cascade');
            $table->foreign('price_pattern_id')->references('id')
                ->on('price_patterns')->onDelete('cascade');

        });

        Schema::create('seat_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seat_id')->unsigned();
            $table->integer('hall_price_pattern_id')->unsigned();
            $table->integer('price_zone_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('seat_id')->references('id')
                ->on('seats')->onDelete('cascade');
            $table->foreign('hall_price_pattern_id')->references('id')
                ->on('hall_price_patterns')->onDelete('cascade');
            $table->foreign('price_zone_id')->references('id')
                ->on('price_zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seat_prices', function (Blueprint $table) {
            $table->dropForeign(['seat_id']);
            $table->dropForeign(['hall_price_pattern_id']);
            $table->dropForeign(['price_zone_id']);
        });

        Schema::dropIfExists('seat_prices');

        Schema::table('hall_price_patterns', function (Blueprint $table) {
            $table->dropForeign(['hall_id']);
            $table->dropForeign(['price_pattern_id']);
        });

        Schema::dropIfExists('hall_price_patterns');

        Schema::table('price_zones', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
            $table->dropForeign(['price_pattern_id']);
        });

        Schema::dropIfExists('price_zones');

        Schema::dropIfExists('price_patterns');

        Schema::dropIfExists('colors');
    }
}
