<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColTitleGalleryModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('title')->nullable();
        });

        Schema::table('models', function (Blueprint $table) {
            $table->string('model_image_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('title');
        });

        Schema::table('models', function (Blueprint $table) {
            $table->dropColumn('model_image_title');
        });
    }
}
