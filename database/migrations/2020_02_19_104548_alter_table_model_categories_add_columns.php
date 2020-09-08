<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableModelCategoriesAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('model_categories', function (Blueprint $table){
           $table->string('seo_title')->nullable();
           $table->string('seo_description')->nullable();
           $table->string('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model_categories', function (Blueprint $table){
           $table->dropColumn('seo_title');
           $table->dropColumn('seo_description');
           $table->dropColumn('slug');
        });
    }
}
