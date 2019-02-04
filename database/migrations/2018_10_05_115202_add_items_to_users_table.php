<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemsToUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('name');
			$table->string('login', 50)->unique();
			$table->string('firstName', 50);
			$table->string('lastName', 50);
			$table->string('phone', 15);
			$table->integer('country_id')->unsigned()->nullable();
			$table->string('city', 50)->nullable();
			$table->string('street', 50)->nullable();
			$table->integer('houseNumber')->nullable();
			$table->boolean('confirmed')->default(0);

			$table->foreign('country_id')->references('id')
				->on('countries')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->string('name');
			$table->dropColumn('login');
			$table->dropColumn('firstName');
			$table->dropColumn('lastName');
			$table->dropColumn('phone');
			$table->dropForeign([
				'country_id'
			]);
			$table->dropColumn('country_id');
			$table->dropColumn('city');
			$table->dropColumn('street');
			$table->dropColumn('houseNumber');
			$table->dropColumn('confirmed');
		});
	}
}
