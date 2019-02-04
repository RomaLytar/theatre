<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->text('json_code');
            $table->text('html_code');
            $table->integer('width');
            $table->integer('height');
            $table->boolean('is_active_cash_box')->default(false);
            $table->boolean('is_active_online')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_templates');
    }
}
