<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorRoleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_role_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actor_role_id')->unsigned();
            $table->string('language', 10);
            $table->string('title');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('actor_role_id')->references('id')
                ->on('actor_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actor_role_translations', function (Blueprint $table) {
            $table->dropForeign([
                'actor_role_id'
            ]);
        });
        Schema::dropIfExists('actor_role_translations');
    }
}
