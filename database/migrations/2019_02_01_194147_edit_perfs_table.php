<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPerfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->float('price')->nullable()->change();
            $table->string('duration')->nullable()->change();
        });

        Schema::table('performance_translations', function (Blueprint $table) {
            $table->text('descriptions')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_translations', function (Blueprint $table) {
            $table->text('descriptions')->change();
        });

        Schema::table('performances', function (Blueprint $table) {
            $table->float('price')->change();
            $table->string('duration')->change();
        });
    }
}
