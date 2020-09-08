<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubattributeOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subattribute_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subattribute_id');
            $table->foreign('subattribute_id')->references('id')->on('features');
            $table->string('label');
            $table->string('value');
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
        Schema::dropIfExists('subattribute_options');
    }
}
