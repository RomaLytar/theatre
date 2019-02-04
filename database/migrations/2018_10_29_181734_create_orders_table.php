<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('email')->nullable();
            $table->integer('phone')->nullable();
            $table->string('color_code');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('performance_calendar_id')->unsigned();
            $table->integer('seat_price_id')->unsigned();
            $table->boolean('isAvailable')->default(1);
            $table->integer('distributor_id')->unsigned()->nullable();
            $table->dateTime('activated_at')->nullable();
            $table->timestamps();

            $table->foreign('performance_calendar_id')->references('id')
                ->on('performance_calendars')->onDelete('cascade');
            $table->foreign('seat_price_id')->references('id')
                ->on('seat_prices')->onDelete('cascade');
            $table->foreign('distributor_id')->references('id')
                ->on('distributors')->onDelete('cascade');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['waiting_for_payment', 'sold', 'booked', 'returned', 'cancelled']);
            $table->integer('seller_id')->unsigned()->nullable();
            $table->integer('buyer_id')->unsigned()->nullable();
            $table->boolean('payment_type')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('hash')->nullable();
            $table->timestamps();
            $table->dateTime('expires_at')->nullable();

            $table->foreign('seller_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')
                ->on('users')->onDelete('cascade');
        });

        Schema::create('order_tickets', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
            $table->integer('ticket_id')->unsigned();

            $table->foreign('order_id')->references('id')
                ->on('orders')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')
                ->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_tickets', function (Blueprint $table) {
            $table->dropForeign(['ticket_id']);
            $table->dropForeign(['order_id']);
        });
        Schema::dropIfExists('order_tickets');

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['buyer_id']);
            $table->dropForeign(['seller_id']);
        });
        Schema::dropIfExists('orders');

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['distributor_id']);
            $table->dropForeign(['seat_price_id']);
            $table->dropForeign(['performance_calendar_id']);
        });
        Schema::dropIfExists('tickets');

        Schema::table('distributors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('distributors');
    }
}
