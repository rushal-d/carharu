<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subattributeoptiongallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subattribute_option_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('model_id')->nullable();
            $table->foreign('model_id')->references('model_id')->on('models')->onDelete('cascade');
            $table->unsignedInteger('subattribute_option_id')->nullable();
            $table->foreign('subattribute_option_id')->references('id')->on('subattribute_options')->onDelete('cascade');
            $table->unsignedInteger('gallery_id')->nullable();
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
