<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_category_id')->unsigned();
            $table->string('language');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('partner_category_id')->references('id')
              ->on('partner_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_category_translations', function (Blueprint $table) {
            $table->dropForeign([
                'partner_category_id'
            ]);
        });
        Schema::dropIfExists('partner_category_translations');
    }
}
